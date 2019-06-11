<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Contact;
use App\Helpers\HelperFunctions;
use App\Repertoire;
use App\Telephone;
use App\Message;
use App\Autredestinataire;
use App\Envoi;
use Validator;
use Auth;

class MessageController extends Controller
{
    public $successStatus = 200;
    /**
     * sendMessage api
     *
     * @return \Illuminate\Http\Response
     */
    public function sendMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required',
            'id_user' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $user = User::where(['id' => $input['id_user']])->first();
        $repertoire = Repertoire::where(['id_user' => $user['id']])->first();
        if ($user == null) {
            $datas = [
                'added' => 'false'
            ];
            return response()->json(['server_response' => $datas]);
        } else {
            $newMessage = new Message;
            $newMessage->id_user = $input['id_user'];
            $newMessage->contenu = $input['message'];
            $newMessage->save();
            $datas = [
                'added' => 'true',
                'id_message' => $newMessage->id,
                'contenu' => $newMessage->contenu
            ];
            return response()->json(['server_response' => $datas]);
        }
    }
    public function sendMessageOld(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_message' => 'required',
            'numero' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $message = Message::where(['id' => $input['id_message']])->first();
        if ($message == null) {
            $datas = [
                'sended' => 'false'
            ];
            return response()->json(['server_response' => $datas]);
        } else {
            $user = User::where(['id' => $message['id_user']])->first();
            $result = HelperFunctions::sendSmsMessage($input['numero'], $message['contenu'], $user['pseudo']);
            $array =  explode(' ', $result);
            if ($array[0] == 'ERR:') {
                $status =  $array[1] . '' . $array[2] . '' . $array[3];
            } else if ($array[1] == 'ID:') {
                $status = $array[2];
            }
            $newEnvoi = new Envoi;
            $newEnvoi->id_message = $input['id_message'];
            $newEnvoi->numero = $input['numero'];
            $newEnvoi->status = $status;
            $newEnvoi->save();
            $datas = [
                'sended' => 'true',
            ];
            return response()->json(['server_response' => $datas]);
        }
    }
    public function sendMessageOther(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_message' => 'required',
            'numero' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $message = Message::where(['id' => $input['id_message']])->first();
        if ($message == null) {
            $datas = [
                'sended' => 'false'
            ];
            return response()->json(['server_response' => $datas]);
        } else {
            $user = User::where(['id' => $message['id_user']])->first();
            $result = HelperFunctions::sendSmsMessage($input['numero'], $message['contenu'], $user['pseudo']);
            $array =  explode(' ', $result);
            if ($array[0] == 'ERR:') {
                $status =  $array[1] . '' . $array[2] . '' . $array[3];
            } else if ($array[1] == 'ID:') {
                $status = $array[2];
            }
            $newAutredestinataire = new Autredestinataire;
            $newAutredestinataire->id_message = $input['id_message'];
            $newAutredestinataire->numero = $input['numero'];
            $newAutredestinataire->status = $status;
            $newAutredestinataire->save();
            $datas = [
                'sended' => 'true',
            ];
            return response()->json(['server_response' => $datas]);
        }
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
                $telephone = Telephone::where(['id' => $envoi['id_telephone']])->first();
                $contact = Contact::where(['id' => $telephone['id_contact']])->first();
                $destinataire_list .= '<b>' . $contact->last_name . ' ' . $contact->first_name . ' -- ' . $telephone->numero . '</b><hr>';
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
    public function viewMessages(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        $input = $request->all();
        $user = User::where(['id' => $input['id']])->first();
        $datas = array();
        if ($user == null) {
            array_push($datas, array(
                "founded" => 'false'
            ));
            return response()->json(['server_response' => $datas]);
        } else {
            $messages = Message::where(['id_user' => $user['id']])->get();
            foreach ($messages as $message) {
                $myDestinataires = array();
                $autreDestinataires = Autredestinataire::where(['id_message' => $message['id']])->get();
                foreach ($autreDestinataires as $autreDestinataire) {
                    array_push($myDestinataires, array(
                        "reference" => 'Non enregistré',
                        "numero" => $autreDestinataire->numero,
                    ));
                }
                $envois = Envoi::where(['id_message' => $message['id']])->get();
                foreach ($envois as $envoi) {
                    if (Telephone::where(['numero' => $envoi['numero']])->first() != null) {
                        $telephone = Telephone::where(['numero' => $envoi['numero']])->first();
                        $contact = Contact::where(['id' => $telephone['id_contact']])->first();
                        array_push($myDestinataires, array(
                            "reference" => $contact['last_name'] . ' ' . $contact['first_name'],
                            "numero" => $telephone['numero'],
                        ));
                    } else {
                        array_push($myDestinataires, array(
                            "reference" => 'Non enregistré',
                            "numero" => $autreDestinataire->numero,
                        ));
                    }
                }
                array_push($datas, array(
                    "id_message" => $message['id'],
                    "contenu" => $message['contenu'],
                    "date_envoi" => $message['created_at'],
                    "destinataires" => $myDestinataires
                ));
            }
            return response()->json(['server_response' => $datas]);
        }
    }
}
