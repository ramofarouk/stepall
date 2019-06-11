<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Contact;
use App\Repertoire;
use App\Telephone;
use App\Message;
use App\Helpers\HelperFunctions;
use App\Autredestinataire;
use App\Envoi;
use App\Email;
use Auth;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        $user = User::where(['email' => Auth::user()->email])->first();
        $repertoire = Repertoire::where(['id_user' => $user['id']])->first();
        $contacts = Contact::where(['id_repertoire' => $repertoire['id']])->get();
        $mycontacts = "<option value='' selected disabled>Choisir un destinataire</option>";
        foreach ($contacts as $contact) {
            $mycontacts .= "<optgroup label='" . $contact->last_name . " " . $contact->first_name . "'>";
            $telephones = Telephone::where(['id_contact' => $contact['id']])->get();
            foreach ($telephones  as $tel) {
                $mycontacts .= "<option value='" . $tel->numero . "'>" .  $tel->type_numero . "&nbsp;--&nbsp;" . $tel->numero . "</option>";
            }
            $mycontacts .= "</optgroup>";
        }

        if ($request->isMethod('post')) {
            $data = $request->input();
            $user = User::where(['email' => Auth::user()->email])->first();
            $repertoire = Repertoire::where(['id_user' => $user['id']])->first();
            $newMessage = new Message;
            $newMessage->id_user = $user['id'];
            $newMessage->contenu = $data['message'];
            $newMessage->save();
            $i = 1;
            while (isset($data['phone' . $i])) {
                echo $data['phone' . $i];
                $result = HelperFunctions::sendSmsMessage($data['phone' . $i], $data['message'], $user['pseudo']);
                $array =  explode(' ', $result);
                if ($array[0] == 'ERR:') {
                    $status =  $array[1] . '' . $array[2] . '' . $array[3];
                } else if ($array[1] == 'ID:') {
                    $status = $array[2];
                }
                $newAutredestinataire = new Autredestinataire;
                $newAutredestinataire->id_message = $newMessage['id'];
                $newAutredestinataire->status = $status;
                $newAutredestinataire->numero = $data['phone' . $i];
                $newAutredestinataire->save();
                $i += 1;
            }
            $j = 1;
            while (isset($data['old_tel' . $j])) {
                echo $data['old_tel' . $j];
                $result = HelperFunctions::sendSmsMessage($data['old_tel' . $j], $data['message'], $user['pseudo']);
                $array =  explode(' ', $result);
                if ($array[0] == 'ERR:') {
                    $status =  $array[1] . '' . $array[2] . '' . $array[3];
                } else if ($array[1] == 'ID:') {
                    $status = $array[2];
                }
                $newEnvoi = new Envoi;
                $newEnvoi->id_message = $newMessage['id'];
                $newEnvoi->status = $status;
                $newEnvoi->numero = $data['old_tel' . $j];
                $newEnvoi->save();
                $j += 1;
            }
            $z = $i + $j;
            $z -= 2;
            return back()->with('flash_message_success', 'Vous avez envoyé un message à ' . $z . ' personnes avec succès!');
            /*echo "<pre>";
            print_r($data);
            die;*/
        }
        return view('user.send_message')->with(compact('user', 'mycontacts'));
    }

    public function viewMessagesReceive(Request $request)
    {
        $user = User::where(['email' => Auth::user()->email])->first();
        $repertoire = Repertoire::where(['id_user' => $user['id']])->first();
        $contacts = Contact::where(['id_repertoire' => $repertoire['id']])->get();
        foreach ($contacts as $contact) {
            $messages = Message::where(['id_user' => $user['id']])->get();
            foreach ($messages as $message) { }
        }
        $messages = Message::where(['id_user' => $user['id']])->get();
        $messages_list = '';
        foreach ($messages as $message) {
            $destinataire_list = '';
            $autreDestinataires = Autredestinataire::where(['id_message' => $message['id']])->get();
            foreach ($autreDestinataires as $autreDestinataire) {
                $destinataire_list .= '<b>' . $autreDestinataire->numero . '</b><hr>';
            }
            $envois = Envoi::where(['id_message' => $message['id']])->get();
            foreach ($envois as $envoi) {
                $telephone = Telephone::where(['id' => $envoi['telephone']])->first();
                $destinataire_list .= '<b>' . $telephone->numero . '</b><hr>';
            }
            $messages_list .= '<tr>
                                    <td>' . $message->contenu . '</td>
                                    <td>' . $message->contenu . '</td>
                                    <td><span class="label label-success">' . $message->created_at . ' </span></td>
                                    <td>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteCard' . $message->id . '">
                                                Supprimer
                                        </button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="deleteCard' .  $message->id . '" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form>
                            <div class="modal-header">
                                <h5 class="modal-title" id="createModalLabel"><i class="ti-marker-alt m-r-10"></i> Suppression </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Etes-vous sûr de supprimer ce message avec toutes ses informations</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                <a href="/user/delete-message/' . $message->id . '" class="btn btn-success"> Oui</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                                    ';
        }
        return view('user.messages_receive')->with(compact('messages_list', 'user'));
    }
    public function viewMessagesSend(Request $request)
    {
        $user = User::where(['email' => Auth::user()->email])->first();
        $messages = Message::where(['id_user' => $user['id']])->get();
        $messages_list = '';
        foreach ($messages as $message) {
            $destinataire_list = '';
            $autreDestinataires = Autredestinataire::where(['id_message' => $message['id']])->get();
            foreach ($autreDestinataires as $autreDestinataire) {
                $destinataire_list .= '<b> Non enregistré -- ' . $autreDestinataire->numero . '</b><hr>';
            }
            $envois = Envoi::where(['id_message' => $message['id']])->get();
            foreach ($envois as $envoi) {
                if (Telephone::where(['numero' => $envoi['numero']])->first() != null) {
                    $telephone = Telephone::where(['numero' => $envoi['numero']])->first();
                    $contact = Contact::where(['id' => $telephone['id_contact']])->first();
                    $destinataire_list .= '<b>' . $contact->last_name . ' ' . $contact->first_name . ' -- ' . $telephone->numero . '</b><hr>';
                } else {
                    $destinataire_list .= '<b> Non enregistré -- ' . $envoi['numero'] . '</b><hr>';
                }
            }
            $messages_list .= '<tr>
                                    <td>' . $message->contenu . '</td>
                                    <td><span class="label label-success">' . $message->created_at . ' </span></td>
                                    <td>
                                         <button type="button" class="btn btn-info" data-toggle="modal" data-target="#viewCard' . $message->id . '">
                                                Voir le(s) destinataire(s)
                                        </button>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteCard' . $message->id . '">
                                                Supprimer
                                        </button>
                                        </td>
                                     <td><i class="fa fa-circle text-orange" data-toggle="tooltip" data-placement="top" title="In Progress"></i></td>
                                    </tr>
                                    <div class="modal fade" id="deleteCard' .  $message->id . '" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form>
                            <div class="modal-header">
                                <h5 class="modal-title" id="createModalLabel"><i class="ti-marker-alt m-r-10"></i> Suppression </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Etes-vous sûr de supprimer ce message avec toutes ses informations</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                <a href="/user/delete-message/' . $message->id . '" class="btn btn-success"> Oui</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="viewCard' .  $message->id . '" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form>
                            <div class="modal-header">
                                <h5 class="modal-title" id="createModalLabel"><i class="ti-marker-alt m-r-10"></i> Listes des destinataires </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>' .  $destinataire_list . ' </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                                    ';
        }
        return view('user.messages_send')->with(compact('messages_list', 'user'));
    }
    public function viewAllMessages(Request $request)
    {
        $user = User::where(['email' => Auth::user()->email])->first();
        $messages = Message::get();
        $messages_list = '';
        foreach ($messages as $message) {
            $userSended = User::where(['id' => $message['id_user']])->first();
            $destinataire_list = '';
            $autreDestinataires = Autredestinataire::where(['id_message' => $message['id']])->get();
            foreach ($autreDestinataires as $autreDestinataire) {
                $destinataire_list .= '<b> Non enregistré -- ' . $autreDestinataire->numero . '</b><hr>';
            }
            $envois = Envoi::where(['id_message' => $message['id']])->get();
            foreach ($envois as $envoi) {
                if (Telephone::where(['numero' => $envoi['numero']])->first() != null) {
                    $telephone = Telephone::where(['numero' => $envoi['numero']])->first();
                    $contact = Contact::where(['id' => $telephone['id_contact']])->first();
                    $destinataire_list .= '<b>' . $contact->last_name . ' ' . $contact->first_name . ' -- ' . $telephone->numero . '</b><hr>';
                } else {
                    $destinataire_list .= '<b> Non enregistré -- ' . $envoi['numero'] . '</b><hr>';
                }
            }
            $messages_list .= '<tr>
                                    <td>' . $userSended->last_name . ' ' . $userSended->first_name  . '</td>
                                    <td>' . $message->contenu . '</td>
                                    <td><span class="label label-success">' . $message->created_at . ' </span></td>
                                    <td><i class="fa fa-circle text-orange" data-toggle="tooltip" data-placement="top" title="In Progress"></i></td>
                                    <td>
                                         <button type="button" class="btn btn-info" data-toggle="modal" data-target="#viewCard' . $message->id . '">
                                                Voir le(s) destinataire(s)
                                        </button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="viewCard' .  $message->id . '" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form>
                            <div class="modal-header">
                                <h5 class="modal-title" id="createModalLabel"><i class="ti-marker-alt m-r-10"></i> Listes des destinataires </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>' .  $destinataire_list . ' </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
                                    ';
        }
        return view('admin.messages')->with(compact('user', 'messages_list'));
    }
}
