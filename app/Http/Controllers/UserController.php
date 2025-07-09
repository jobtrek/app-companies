<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreationRequest;
use App\Models\Commentaire;
use App\Models\Convention;
use App\Models\Domain;
use App\Models\Entreprise;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserController extends Controller
{
    use AuthorizesRequests;

    public function create(UserCreationRequest $request)
    {
        $user = User::create($request->all());
        if ($user->roles->contains('apprenti_informaticien') || $user->roles->contains('apprenti_commerce')) {
            Convention::create([
                'users_id' => $user->id,
                'entreprise_id' => 1,
                'date_de_départ' => Carbon::now('Europe/Zurich')->format('Y-m-d'),
                'date_de_retour' => null,
            ]);
        }

        return redirect()->route('home')->with('success', 'Utilisateur créé !');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credential do not match our records:(',
        ])->onlyInput('email');
    }

    public function index()
    {
        $apprenties = User::whereJsonContains('roles', 'apprenti_informaticien')
            ->orWhereJsonContains('roles', 'apprenti_commerce')
            ->paginate(16);

        $entreprises = Entreprise::all();

        $filtres = [
            'entreprise' => 'En entreprise',
            'formation' => 'En centre de formation',
            'alphabetique' => 'Par ordre alphabétique',
            'informaticien-dev' => 'Informaticien développement',
            'employe-com' => 'Employé de commerce',
        ];

        return view('homepage', [
            'apprentis' => $apprenties,
            'entreprises' => $entreprises,
            'filtres' => $filtres,
        ]);
    }

    public function coach(Commentaire $commentaire)
    {
        $this->authorize('coach');
        $coachId = auth()->id();

        $apprentis = User::where('coach_id', $coachId)
            ->with('commentaires')
            ->paginate(5);
        return view('coach', ['apprentis' => $apprentis, 'comment' => $commentaire]);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        $coach = User::whereJsonContains('roles', 'coach')->get();
        $entreprises = Entreprise::where('domain_id', $user->domain_id)->get();
        $previousCompanies = Convention::where('users_id', $user->id)->orderBy('created_at', 'DESC')->get();
        $commentaire = Commentaire::where('apprentis_id', $id)
            ->latest()
            ->take(3)
            ->get();

        $lastcommentaire = Commentaire::where('apprentis_id', $id)->latest()->first();

        return view('userProfile', ['user' => $user,
            'coach' => $coach, 'entreprises' => $entreprises, 'previousCompanies' => $previousCompanies,
            'comment' => $commentaire, 'lastcommentaire' => $lastcommentaire]);
    }

    public function updateCoach(Request $request, User $user)
    {

        $request->validate([
            'coach_id' => 'required|exists:users,id',
        ]);

        $user->coach_id = $request->input('coach_id');
        $user->save();

        return back()->with('success', 'Coach lié avec succès !');
    }

    public function updateEntreprise(Request $request, User $user)
    {
        $request->validate([
            'entreprise_id' => 'required|exists:entreprises,id',
        ]);

        $lastConvention = Convention::where('users_id', $user->id)->orderBy('created_at', 'desc')->first();

        if ($lastConvention) {
            $lastConvention->date_de_retour = Carbon::now('Europe/Zurich')->format('Y-m-d');
            $lastConvention->save();
        }

        Convention::create([
            'users_id' => $user->id,
            'entreprise_id' => $request->input('entreprise_id'),
            'date_de_départ' => Carbon::now('Europe/Zurich')->format('Y-m-d'),
            'date_de_retour' => null,
        ]);

        $user->entreprise_id = $request->input('entreprise_id');
        $user->save();

        return back()->with('success', 'Entreprise modifiée !');
    }

    public function updateProfil(Request $request, User $user)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id . ',id',
            'phone_number' => 'required|numeric|digits_between:7,15',
        ]);

        $user->email = $request->input('email');
        $user->phone_number = $request->input('phone_number');

        $user->save();

        return back()->with('success', 'Profil mis à jour avec succès.');
    }


    public function sort($sort)
    {
        $filtres = [
            'entreprise' => 'En entreprise',
            'formation' => 'En centre de formation',
            'alphabetique' => 'Par ordre alphabétique',
            'informaticien-dev' => 'Informaticien développement',
            'employe-com' => 'Employé de commerce',
        ];

        $entreprises = Entreprise::all();

        if ($sort == 'entreprise') {
            $apprenties = User::whereJsonContains('roles', 'apprenti_informaticien')
                ->whereNotIn('entreprise_id', [1])
                ->orWhereJsonContains('roles', 'apprenti_commerce')
                ->whereNotIn('entreprise_id', [1]);
        } elseif ($sort == 'formation') {
            $apprenties = User::whereJsonContains('roles', 'apprenti_informaticien')
                ->where('entreprise_id', 1)
                ->orWhereJsonContains('roles', 'apprenti_commerce')
                ->where('entreprise_id', 1);
        } elseif ($sort == 'alphabetique') {
            $apprenties = User::whereJsonContains('roles', 'apprenti_informaticien')
                ->orWhereJsonContains('roles', 'apprenti_commerce')
                ->orderBy('name', 'ASC');
        } elseif ($sort == 'informaticien-dev') {
            $apprenties = User::whereJsonContains('roles', 'apprenti_informaticien');
        } elseif ($sort == 'employe-com') {
            $apprenties = User::whereJsonContains('roles', 'apprenti_commerce');
        } else {
            return back()->withErrors(['Choisissez un filtre valable.']);
        }

        return view('homepage', [
            'apprentis' => $apprenties->paginate(16),
            'entreprises' => $entreprises,
            'filtres' => $filtres,
        ]);
    }

    public function showDomain()
    {
        $domains = Domain::all();

        return view('createaccount', ['domains' => $domains]);
    }

    public function destroy(User $user)
    {

        $this->authorize('admin');

        $user->commentaires()->delete();
        $user->convention()->delete();
        $user->delete();

        return redirect()->route('home')->with('success', 'Utilisateur supprimé');
    }

    public function userUpdateShow($id)
    {
        $formateur = auth()->user();
        $apprenti = User::findOrFail($id);
        $this->authorize('check_domains_apprenti_formateur', $apprenti);
        $user = User::findOrFail($id);
        $coach = User::whereJsonContains('roles', "coach")->get();
        $entreprises = Entreprise::where('domain_id', $user->domain_id)->get();
        $previousCompanies = Convention::where('users_id', $user->id)->orderBy('created_at', 'DESC')->get();

        return view('userProfileUpdate', ['user' => $user, 'coach' => $coach, 'entreprises' => $entreprises, 'previousCompanies' => $previousCompanies]);
    }
}
