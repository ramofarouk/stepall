<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Contact;
use App\Repertoire;
use App\Telephone;
use App\Email;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Validation\Rules\Exists;

class ContactController extends Controller
{
    public $successStatus = 200;
    /**
     * addContact api
     *
     * @return \Illuminate\Http\Response
     */
    public function addContact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'note' => 'required',
            'id_user' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $user = User::where(['id' => $input['id_user']])->first();
        if ($user == null) {
            $datas = [
                'added' => 'false'
            ];
            return response()->json(['server_response' => $datas]);
        } else {
            $repertoire = Repertoire::where(['id_user' => $user['id']])->first();
            //$newContact = Contact::create($input);
            $newContact = new Contact;
            $newContact->id_repertoire = $repertoire['id'];
            $newContact->first_name = $input['first_name'];
            $newContact->last_name = $input['last_name'];
            $newContact->url_photo = 'mes_contacts/test.jpg';
            $newContact->note = $input['note'];
            $newContact->save();
            $datas = [
                'added' => 'true',
                'id_contact' => $newContact->id,
                'first_name' => $newContact->first_name,
                'last_name' => $newContact->last_name,
            ];
            return response()->json(['server_response' => $datas]);
        }
    }
    public function addContactEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_contact' => 'required',
            'type_mail' => 'required',
            'email' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $contact = Contact::where(['id' => $input['id_contact']])->first();
        if ($contact == null) {
            $datas = [
                'added' => 'false'
            ];
            return response()->json(['server_response' => $datas]);
        } else {
            $newEmail = new Email;
            $newEmail->id_contact = $input['id_contact'];
            $newEmail->type_mail = $input['type_mail'];
            $newEmail->email = $input['email'];
            $newEmail->save();
            $datas = [
                'added' => 'true',
            ];
            return response()->json(['server_response' => $datas]);
        }
    }
    public function addContactPhone(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_contact' => 'required',
            'type_numero' => 'required',
            'numero' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $contact = Contact::where(['id' => $input['id_contact']])->first();
        if ($contact == null) {
            $datas = [
                'added' => 'false'
            ];
            return response()->json(['server_response' => $datas]);
        } else {
            $newTelephone = new Telephone;
            $newTelephone->id_contact = $input['id_contact'];
            $newTelephone->type_numero = $input['type_numero'];
            $newTelephone->numero = $input['numero'];
            $newTelephone->save();
            $datas = [
                'added' => 'true',
            ];
            return response()->json(['server_response' => $datas]);
        }
    }
    /**
     * List Contacts api
     *
     * @return \Illuminate\Http\Response
     */
    public function listContacts(Request $request)
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
            $repertoire = Repertoire::where(['id_user' => $user['id']])->first();
            $contacts = Contact::where(['id_repertoire' => $repertoire['id']])->orderBy('last_name', 'asc')->get();
            foreach ($contacts as $contact) {
                $telephones = Telephone::where(['id_contact' => $contact['id']])->get();
                foreach ($telephones as $telephone) {
                    array_push($datas, array(
                        "id_contact" => $contact['id'],
                        "id_telephone" => $telephone['id'],
                        "last_name" => $contact['last_name'],
                        "first_name" => $contact['first_name'],
                        "numero" => $telephone['numero'],
                        "picture" => $contact['url_photo']
                    ));
                }
            }
            return response()->json(['server_response' => $datas]);
        }
    }
    public function viewContacts(Request $request)
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
            $repertoire = Repertoire::where(['id_user' => $user['id']])->first();
            $contacts = Contact::where(['id_repertoire' => $repertoire['id']])->orderBy('last_name', 'asc')->get();
            foreach ($contacts as $contact) {
                $myTelephones = array();
                $myEmails = array();
                $telephones = Telephone::where(['id_contact' => $contact['id']])->get();
                foreach ($telephones as $telephone) {
                    array_push($myTelephones, array(
                        "id_telephone" => $telephone['id'],
                        "type_numero" => $telephone['type_numero'],
                        "numero" => $telephone['numero'],
                    ));
                }
                $emails = Email::where(['id_contact' => $contact['id']])->get();
                foreach ($emails as $email) {
                    array_push($myEmails, array(
                        "id_email" => $email['id'],
                        "type_mail" => $email['type_mail'],
                        "email" => $email['email'],
                    ));
                }
                array_push($datas, array(
                    "id_contact" => $contact['id'],
                    "note" => $contact['note'],
                    "last_name" => $contact['last_name'],
                    "first_name" => $contact['first_name'],
                    "picture" => $contact['url_photo'],
                    "telephones" => $myTelephones,
                    "emails" => $myEmails,
                ));
            }
            return response()->json(['server_response' => $datas]);
        }
    }
    public function editContact(Request $request, $id  = null)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg,max=4048',
            ]);
            $data = $request->input();
            $user = User::where(['email' => Auth::user()->email])->first();
            $fileInfo['imagename'] = Contact::where(['id' => $id])->first()->url_photo;
            $urlFinal = $fileInfo['imagename'];
            if ($request->file('image') != null) {
                $image = $request->file('image');
                $fileInfo['imagename'] = $data['first_name'] . '_' . $data['last_name'] . '_' .  $user['id'] . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/mes_contacts');
                $image->move($destinationPath, $fileInfo['imagename']);
                $urlFinal = 'mes_contacts/' . $fileInfo['imagename'];
            }
            Contact::where(['id' => $id])->update([
                'first_name' => $data['first_name'], 'last_name' => $data['last_name'], 'note' => $data['note'],
                'url_photo' => $urlFinal,
            ]);
            return redirect('/user/view-contacts')->with('flash_message_success', 'Contact mis à jour avec succès!');
        }
        $user = User::where(['email' => Auth::user()->email])->first();
        $contactDetails = Contact::where(['id' => $id])->first();
        $telephones = Telephone::where(['id_contact' => $contactDetails['id']])->get();
        $emails = Email::where(['id_contact' => $contactDetails['id']])->get();
        return view('user.edit_contact')->with(compact('contactDetails', 'user', 'telephones', 'emails'));
    }
    public function contactDetails(Request $request, $id  = null)
    {
        $user = User::where(['email' => Auth::user()->email])->first();
        $contactDetails = Contact::where(['id' => $id])->first();
        $telephones = Telephone::where(['id_contact' => $contactDetails['id']])->get();
        $emails = Email::where(['id_contact' => $contactDetails['id']])->get();
        return view('user.contacts_details')->with(compact('contactDetails', 'user', 'telephones', 'emails'));
    }
    public function deleteContact($id = null)
    {
        if (!empty($id)) {
            Contact::where(['id' => $id])->delete();
            Telephone::where(['id_contact' => $id])->delete();
            Email::where(['id_contact' => $id])->delete();
            return redirect()->back()->with('flash_message_success', 'Le contact et toutes ses informations ont été supprimés avec succès!');
        } else {
            return redirect()->back()->with('flash_message_error', 'Erreur survenue lors de la suppression!');
        }
    }
}
