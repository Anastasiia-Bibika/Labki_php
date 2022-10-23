<?php

class AccountsCollection
{
    public $accounts;

    public function __construct()
    {
    }

    public function defaultAccounts()
    {
        $this->accounts = [
            new Account(1, [
                'code'=> 1,
                'fullname' => "Dmitriy Yuriovich Prodan",
                'state' => "teacher",
                'salary'=>18000,
                'children'=> 18,
                'experience'=> "3 years"
            ]),
            new Account(2, [
                'code'=> 2,
                'fullname' => "Georgy Ivanovych Kovalenko",
                'state' => "head teacher",
                'salary'=>20000,
                'children'=> 21,
                'experience'=> "5 years"
            ]),
            new Account(3, [
                'code'=> 3,
                'fullname' => "Myroslava Andriivna Kruch",
                'state' => "director",
                'salary'=>23000,
                'children'=> 19,
                'experience'=> "7 years"
            ]),
            new Account(4, [
                'code'=> 4,
                'fullname' => "Ioanna Michalivna Vetcka",
                'state' => "Educator",
                'salary'=>16000,
                'children'=> 20,
                'experience'=> "3 years"
            ])
        ];
        return $this;
    }

    public function getAccountById($id)
    {
        foreach ($this->accounts as $account) {
            if ($account->id == $id) {
                return $account;
            }
        }
        return null;
    }

    public function filterAccounts($state, $children)
    {
        return array_filter(
            $this->accounts,
            function ($value) use ($state, $children) {
                return ($value->state == $state and $value->children < $children or $value->children == $children);
            }
        );
    }

    public function addAccount($account)
    {
        $this->accounts[] = $account;
    }

    public function editAccount($array)
    {
        $account = $this->getAccountById($array['code']);
        if (!(empty($account))) {
            $account->fullname = $array['fullname'];
            $account->state = $array['state'];
            $account->salary = $array['salary'];
            $account->children = $array['children'];
            $account->experience = $array['experience'];
        }
    }

    public function saveAccounts()
    {
        $file = fopen("accounts.txt", "w");
        fwrite($file, serialize($this->accounts));
        fclose($file);
    }

    public function loadAccounts()
    {
        $this->accounts = unserialize(file_get_contents("accounts.txt"));
    }

    public function displayAccounts()
    {
        $table = '<table>';
        $table .= '<tr> <th>code</th> <th>fullname</th> <th>state</th> <th>salary</th> <th>children</th> <th>experience</th></tr>';

        foreach ($this->accounts as $item) {
            $table .= "<tr><td>$item->code</td><td>$item->fullname</td><td>$item->state</td>" .
                "<td>$item->salary</td><td>$item->children</td><td>$item->experience</td></tr>";
        }

        $table .= '</table>';
        return $table;
    }

    public function displayFilteredAccounts($state, $children)
    {
        $array = $this->filterAccounts($state, $children);
        $table = '<table>';
        $table .= '<tr> <th>code</th> <th>fullname</th> <th>state</th> <th>salary</th> <th>children</th> <th>experience</th></tr>';

        foreach ($array as $item) {
            $table .= "<tr><td>$item->code</td><td>$item->fullname</td><td>$item->state</td>" .
                "<td>$item->salary</td><td>$item->children</td><td>$item->experience</td></tr>";
        }

        $table .= '</table>';
        return $table;
    }
}