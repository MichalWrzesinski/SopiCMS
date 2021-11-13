<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Mail\SendMail;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Repository\UserRepository as UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    private $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function get(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function list($search = [], $limit = null, $order = 'name', $direction = 'ASC')
    {
        $list = $this->model->where(function($query) use($search) {
            if(isset($search['id']) && $search['id'] == 1 && (int)$search['search'] > 0) $query->orWhere('id', (int)$search['search']);
            if(isset($search['name']) && $search['name'] == 1) $query->orWhere('name', 'like', '%'.$search['search'].'%');
            if(isset($search['email']) && $search['email'] == 1) $query->orWhere('email', 'like', '%'.$search['search'].'%');
        })->orderBy($order, $direction);

        if($limit > 0) {
            return $list->paginate($limit);
        }

        return $list->get();
    }

    public function update(int $id, $data)
    {
        return $this->model->findOrFail($id)->update($data);
    }

    public function delete(int $id)
    {
        return $this->model->findOrFail($id)->delete();
    }

    public function login($data)
    {
        if(Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'status' => 1])) {
            return true;
        }

        return false;
    }

    public function add($data)
    {
        if(!isset($data['status'])) {
            $data['status'] = 0;
        }

        $password = Hash::make($data['password']);

        $user = $this->model->create([
            'status' => $data['status'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $password,
        ]);

        if($data['status'] == 0) {
            Mail::to($data['email'])
                ->send(new SendMail([
                    'subject' => 'Aktywacja konta',
                    'body' => 'Twoje konto zostało założone. Aby dokonać aktywacji zweryfikuj swój adres e-mail klikając w poniższy odnośnik.',
                    'reply' => config('sopicms.email'),
                    'button' => 'Zweryfikuj konto',
                    'url' => route('user.activate.send', ['id' => $user->id, 'hash' => sha1($data['name'].$password)])
                ]));
        }

        return $user->id;
    }

    public function active(int $id, string $hash)
    {
        $user = $this->model->findOrFail($id);
        if(sha1($user->name.$user->password) <> $hash) {
            return false;
        }
        if($user->status == 0) {
            $user->status = 1;
        }
        if($user->email_verified_at == null) {
            $user ->email_verified_at = Carbon::now();
        }
        $user->save();

        return true;
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
    }

    public function passwordInit($data)
    {
        $user = $this->model->where('email', '=', $data['email'])->firstOrFail();

        Mail::to($user->email)
            ->send(new SendMail([
                'subject' => 'Przypomnij hasło',
                'body' => 'Otrzymaliśmy zgłoszenie o konieczności przypomnienia Twojego hasła. Kliknij w poniższy odnośnik, by wygenerować nowe hasło.',
                'reply' => config('sopicms.email'),
                'button' => 'Wygeneruj nowe hasło',
                'url' => route('user.password.new', ['id' => $user->id, 'hash' => sha1($user->name.$user->password)])
            ]));

        return true;
    }

    public function passwordVeryfi(int $id, string $hash)
    {
        $user = $this->model->findOrFail($id);

        if(sha1($user->name.$user->password) <> $hash) {
            return false;
        }

        return true;
    }

    public function passwordReset(int $id, $data)
    {
        return $this->model->findOrFail($id)->update([
            'password' => Hash::make($data['password']),
        ]);
    }

    public function newsletter(string $title, string $content)
    {
        return Mail::to($this->list())
            ->send(new SendMail([
                'subject' => $title,
                'body' => $content,
                'reply' => config('sopicms.email'),
            ]));
    }
}
