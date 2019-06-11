<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\User;
use App\Repertoire;
use App\Helpers\HelperFunctions;
use Illuminate\Support\Facades\Hash;
use App\Contact;
use App\Telephone;
use App\Message;
use App\Autredestinataire;
use App\Envoi;
use App\Email;

class UserController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->input();
            if (
                Auth::attempt(['email' => $data['email_or_telephone'], 'password' => $data['password'], 'status' => '1']) ||
                Auth::attempt(['telephone' => $data['email_or_telephone'], 'password' => $data['password'], 'status' => '1'])
            ) {
                return redirect('/user');
            } else if (
                Auth::attempt(['email' => $data['email_or_telephone'], 'password' => $data['password'], 'status' => '2']) ||
                Auth::attempt(['telephone' => $data['email_or_telephone'], 'password' => $data['password'], 'status' => '2'])
            ) {
                return redirect('/admin');
            } else {
                return redirect('/')->with('flash_message_error', 'Email/Numéro de téléphone ou Mot de passe invalide');
            }
        }
        return view('login');
    }
    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            if ($data['password'] == $data['c_password']) {
                if (!User::where(['email' => $data['email']])->first() && !User::where(['telephone' => $data['phone']])->first()) {
                    $newUser = new User;
                    $newUser->first_name = $data['first_name'];
                    $newUser->last_name = $data['last_name'];
                    $newUser->pseudo = $data['pseudo'];
                    $newUser->email = $data['email'];
                    $newUser->telephone = $data['phone'];
                    $newUser->status = 1;
                    $newUser->password = bcrypt($data['password']);
                    $code = mt_rand(1000, 9999);
                    $newUser->code = $code;
                    $newUser->save();
                    $request->session()->put('code', $code);
                    return redirect('/verification')->with('code', $code);
                }
                return redirect('/register-user')->with('flash_message_error', 'Cet email ou numéro de téléphone est déjà utilisé!');
            }
            return redirect('/register-user')->with('flash_message_error', 'Mots de passe non identiques!');
        }
        return view('register');
    }
    public function forget_pwd(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->input();
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'admin' => '1'])) {
                //$request->session()->put('adminSession', $data['email']);
                return redirect('/admin/dashboard');
            } else {
                return redirect('/admin')->with('flash_message_error', 'Email ou Mot de passe invalide');
            }
        }
        return view('forget-pwd');
    }
    public function smsTest(Request $request)
    {
        $result = HelperFunctions::sendSmsMessage('+22893554740', 'Test', 'Farouk');
        $array =  explode(' ', $result);
        if ($array[0] == 'ERR:') {
            echo $array[1] . '' . $array[2] . '' . $array[3];
        } else if ($array[1] == 'ID:') {
            echo $array[2];
        }
    }
    public function verification(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->input();
            if ($data['code_true'] == $data['code']) {
                User::where(['code' => $data['code_true']])->update([
                    'active' => 1
                ]);
                $user = User::where(['code' => $data['code_true']])->first();
                /*echo "<pre>";
        print_r($user);
        die;*/
                $newRepertoire = new Repertoire;
                $newRepertoire->id_user = $user['id'];
                $newRepertoire->nbre_contacts = 0;
                $newRepertoire->save();
                Auth::login($user);
                return redirect('/user');
            }
            return redirect('/verification')->with('flash_message_error', 'Code invalide!')->with('code', $data['code_true']);
        }
        return view('verification');
    }
    public function adminDashboard()
    {
        $user = User::where(['email' => Auth::user()->email])->first();
        $messages = Message::get();
        $repertoire = Repertoire::where(['id_user' => $user['id']])->first();
        $users = User::where(['status' => 1])->get();
        $number_messages = $messages->count();
        $number_users = $users->count();
        return view('admin.dashboard')->with(compact('user', 'number_messages', 'number_users'));
    }
    public function footerMessage()
    {
        $user = User::where(['email' => Auth::user()->email])->first();
        return view('admin.footer_message')->with(compact('user'));
    }
    public function userDashboard()
    {
        $user = User::where(['email' => Auth::user()->email])->first();
        $messages = Message::where(['id_user' => $user['id']])->orderBy('id', 'desc')->take(5)->get();
        $messages2 = Message::where(['id_user' => $user['id']])->get();
        $currentMonth = date('m');
        $messages3 = Message::where(['id_user' => $user['id']])->whereRaw('MONTH(created_at) = ?', [$currentMonth])->get();
        $repertoire = Repertoire::where(['id_user' => $user['id']])->first();
        $contacts = Contact::where(['id_repertoire' => $repertoire['id']])->get();
        $number_messages = $messages2->count();
        $number_messages_month = $messages3->count();
        $number_contacts = $contacts->count();
        $messages_list = '';
        foreach ($messages as $message) {
            $destinataire_list = '';
            $autreDestinataires = Autredestinataire::where(['id_message' => $message['id']])->get();
            foreach ($autreDestinataires as $autreDestinataire) {
                $destinataire_list .= '<span class="label label-success" style="margin:2px;">' . $autreDestinataire->numero . '</span>';
            }
            $envois = Envoi::where(['id_message' => $message['id']])->get();
            foreach ($envois as $envoi) {
                if (Telephone::where(['numero' => $envoi['numero']])->first() != null) {
                    $telephone = Telephone::where(['numero' => $envoi['numero']])->first();
                    $contact = Contact::where(['id' => $telephone['id_contact']])->first();
                    $destinataire_list .= '<span class="label label-success" style="margin:2px;">' . $contact->last_name . ' ' . $contact->first_name . '</span>';
                } else {
                    $destinataire_list .= '<span class="label label-success" style="margin:2px;">' . $envoi->numero . '</span>';
                }
            }
            $messages_list .= '
      <tr>
      <td>
      <div class="d-flex no-block align-items-center">
      <div class="">
      <h5 class="m-b-0 font-16 font-medium">' . $message->contenu . '</h5></div>
      </div>
      </td>
      <td>' . $message->created_at . '</td>
      <td>' . $destinataire_list . '</td>
      <td><i class="fa fa-circle text-orange" data-toggle="tooltip" data-placement="top" title="In Progress"></i></td>
      </tr>
      ';
        }
        return view('user.dashboard')->with(compact('user', 'messages_list', 'number_messages', 'number_contacts', 'number_messages_month'));
    }
    public function logout()
    {
        Session::flush();
        return redirect('/')->with('flash_message_success', 'Deconnecté avec succès!');
    }
    public function changePassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $current_pwd = $data['c_password'];
            $user = User::where(['id' => Auth::user()->id])->first();
            if (Hash::check($current_pwd, $user->password)) {
                if ($data['n_password'] == $data['cn_password']) {
                    User::where(['id' => $user['id']])->update([
                        'password' => bcrypt($data['n_password'])
                    ]);
                    return back()->with('flash_message_success', 'Mot de passe mis à jour avec succès!');
                } else {
                    return back()->with('flash_message_error', 'Mots de passe non identiques!');
                }
            } else {
                return back()->with('flash_message_error', 'Mot de passe actuel invalide!');
            }
        }
        $user = User::where(['email' => Auth::user()->email])->first();
        return view('user.change_mdp')->with(compact('user'));
    }
    public function changePasswordAdmin(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $current_pwd = $data['c_password'];
            $user = User::where(['id' => Auth::user()->id])->first();
            if (Hash::check($current_pwd, $user->password)) {
                if ($data['n_password'] == $data['cn_password']) {
                    User::where(['id' => $user['id']])->update([
                        'password' => bcrypt($data['n_password'])
                    ]);
                    return back()->with('flash_message_success', 'Mot de passe mis à jour avec succès!');
                } else {
                    return back()->with('flash_message_error', 'Mots de passe non identiques!');
                }
            } else {
                return back()->with('flash_message_error', 'Mot de passe actuel invalide!');
            }
        }
        $user = User::where(['email' => Auth::user()->email])->first();
        return view('admin.settings')->with(compact('user'));
    }
    public function viewProfile(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $id = $data['id'];
            if (User::where(['email' => $data['email']])->first() || User::where(['telephone' => $data['phone']])->first()) {
                $userFound = User::where(['email' => $data['email']])->first();
                if ($id == $userFound['id']) {
                    User::where(['id' => $id])->update([
                        'first_name' => $data['first_name'], 'last_name' => $data['last_name'], 'pseudo' => $data['pseudo'],
                        'email' => $data['email'], 'telephone' => $data['phone']
                    ]);
                    return redirect('/user/my-profile')->with('flash_message_success', 'Vos informations ont été mises à jour avec succès!');
                } else {
                    return back()->with('flash_message_error', 'Cet email ou numéro de téléphone est déjà utilisé!');
                }
            } else {
                User::where(['id' => $id])->update([
                    'first_name' => $data['first_name'], 'last_name' => $data['last_name'], 'pseudo' => $data['pseudo'],
                    'email' => $data['email'], 'telephone' => $data['phone']
                ]);
                return redirect('/user/my-profile')->with('flash_message_success', 'Vos informations ont été mises à jour avec succès!');
            }
        }
        $user = User::where(['email' => Auth::user()->email])->first();
        return view('user.profile')->with(compact('user'));
    }
    public function viewUsers(Request $request)
    {
        $user = User::where(['email' => Auth::user()->email])->first();
        $users = User::where(['status' => 1])->get();
        $users_list = '';
        foreach ($users as $user) {
            $users_list .= '<tr>
                                    <td>' . $user->last_name . '</td>
                                    <td>' . $user->first_name . '</td>
                                    <td><span class="label label-success">' . $user->pseudo . ' </span></td>
                                    <td>' . $user->email . '</td>
                                    <td>' . $user->telephone . '</td>
                                    </tr>
                                    ';
        }
        return view('admin.users')->with(compact('users_list', 'user'));
    }
}
