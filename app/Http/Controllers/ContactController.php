<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Contact;
use App\Repertoire;
use App\Telephone;
use App\Email;
use Auth;

class ContactController extends Controller
{
    public function addContact(Request $request)
    {
        if ($request->isMethod('post')) {
            //Getting file and analyse
            $this->validate($request, [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,max=4048',
            ]);
            $data = $request->input();
            $image = $request->file('image');
            $user = User::where(['email' => Auth::user()->email])->first();
            $repertoire = Repertoire::where(['id_user' => $user['id']])->first();
            $fileInfo['imagename'] = $data['first_name'] . '_' . $data['last_name'] . '_' .  $user['id'] . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/mes_contacts');
            $image->move($destinationPath, $fileInfo['imagename']);
            $newContact = new Contact;
            $newContact->id_repertoire = $repertoire['id'];
            $newContact->first_name = $data['first_name'];
            $newContact->last_name = $data['last_name'];
            $newContact->url_photo = 'mes_contacts/' . $fileInfo['imagename'];
            $newContact->note = $data['note'];
            $newContact->save();
            $i = 1;
            while (isset($data['phone' . $i])) {
                echo $data['phone' . $i];
                $newTelephone = new Telephone;
                $newTelephone->id_contact = $newContact['id'];
                $newTelephone->type_numero = $data['type_tel' . $i];
                $newTelephone->numero = $data['phone' . $i];
                $newTelephone->save();
                $i += 1;
            }
            $j = 1;
            while (isset($data['mail' . $j])) {
                echo $data['mail' . $j];
                $newEmail = new Email;
                $newEmail->id_contact = $newContact['id'];
                $newEmail->type_mail = $data['type_mail' . $j];
                $newEmail->email = $data['mail' . $j];
                $newEmail->save();
                $j += 1;
            }
            return back()->with('flash_message_success', 'Le contact ' . $data['first_name'] . ' ' . $data['last_name'] . ' a été ajouté avec succès!');
            /*echo "<pre>";
            print_r($data);
            die;*/
        }
        $user = User::where(['email' => Auth::user()->email])->first();
        return view('user.add_contact')->with(compact('user'));
    }
    public function viewContacts(Request $request)
    {
        $user = User::where(['email' => Auth::user()->email])->first();
        $repertoire = Repertoire::where(['id_user' => $user['id']])->first();
        $contacts = Contact::where(['id_repertoire' => $repertoire['id']])->get();
        $contacts_list = '';
        foreach ($contacts as $contact) {
            $contacts_list .= '<tr>
                                    <td>' . $contact->last_name . '</td>
                                    <td>' . $contact->first_name . '</td>
                                    <td><span class="label label-success">' . $contact->note . ' </span></td>
                                    <td>
                                        <a ><img  src="/' . $contact->url_photo . '"  alt="' . $contact->last_name . ' ' . $contact->first_name . '"  class= "rounded-circle" width="75" /></a>
                                    </td>
                                    <td>
                                        <a href="/user/view-contacts/' .  $contact->id . '" class="btn btn-info">
                                                Voir
                                        </a>
                                        <a href="/user/edit-contact/' .  $contact->id . '" class="btn btn-success">
                                                Modifier
                                        </a>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteCard' . $contact->id . '">
                                                Supprimer
                                        </button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="deleteCard' .  $contact->id . '" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
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
                                <p>Etes-vous sûr de supprimer ce contact avec toutes ses informations</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <a href="/user/delete-contact/' . $contact->id . '" class="btn btn-success"> Oui</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                                    ';
        }
        return view('user.contacts')->with(compact('contacts_list', 'user'));
    }
    public function editContact(Request $request, $id  = null)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg,max=4048',
            ]);
            $data = $request->input();
            /*echo "<pre>";
            print_r($data);
            die;*/
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
            Telephone::where(['id_contact' => $id])->delete();
            Email::where(['id_contact' => $id])->delete();
            $i = 1;
            while (isset($data['phone' . $i])) {
                echo $data['phone' . $i];
                $newTelephone = new Telephone;
                $newTelephone->id_contact = $id;
                $newTelephone->type_numero = $data['type_tel' . $i];
                $newTelephone->numero = $data['phone' . $i];
                $newTelephone->save();
                $i += 1;
            }
            $j = 1;
            while (isset($data['mail' . $j])) {
                echo $data['mail' . $j];
                $newEmail = new Email;
                $newEmail->id_contact = $id;
                $newEmail->type_mail = $data['type_mail' . $j];
                $newEmail->email = $data['mail' . $j];
                $newEmail->save();
                $j += 1;
            }
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
