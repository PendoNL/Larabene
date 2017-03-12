<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Validator;
use Request;
use Flash;

use Mail;

class ContactController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        view()->share('meta', [
            'title'         => 'Contact opnemen met Larabene',
            'keywords'      => 'contact, berichtje, email, telefoon, larabene',
            'description'   => 'Larabene is bereikbaar voor iedere Artisan uit Belgie of Nederland, stuur ons gerust een mailtje!'
        ]);

        return view('forms.contact')->with([
            'page_title' => ('Contact opnement met Larabene')
        ]);
    }

    /**
     * @return $this|ContactController|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function post()
    {
        if (Request::has('send')) {
            return $this->sendContactForm();
        }
    }

    /**
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function sendContactForm()
    {
        $validator = Validator::make(Request::all(), [
            'name'      => 'required',
            'telephone' => 'required',
            'email'     => 'required|email',
            'body'      => 'required',
            'g-recaptcha-response' => 'required|recaptcha',
        ])->setAttributeNames([
            'body'      => 'Bericht',
            'name'      => 'Naam',
            'telephone' => 'Telefoonnummer',
            'email'     => 'E-mailadres'
        ]);

        $input = Request::all();
        if ($validator->fails()) {
            return redirect(route('contact'))->withErrors($validator, 'contact')->withInput($input);
        }

        Flash::success('Uw bericht is verzonden, wij proberen zo spoedig mogelijk te antwoorden.');

        Mail::send('emails.forms.contact', ['input' => $input], function ($message) use ($input) {
            $message->from(env('MAIL_FROM'), env('MAIL_NAME'));
            $message->replyTo($input['email'], $input['name']);
            $message->to(env('MAIL_FROM'), env('MAIL_NAME'));
            $message->subject('Iemand heeft contact gezocht via Larabene.com');
        });

        return redirect(route('contact'));
    }
}
