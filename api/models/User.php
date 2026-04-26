<?php

class User {
    private static $file = __DIR__ . '/../data/users.json';

    public static function getAll() {
        if (!file_exists(self::$file)) file_put_contents(self::$file, '[]');
        return json_decode(file_get_contents(self::$file), true);
    }

    public static function saveAll($users) {
        file_put_contents(self::$file, json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    public static function findByEmail($email) {
        $users = self::getAll();
        foreach ($users as $user) {
            if ($user['email'] === $email) return $user;
        }
        return null;
    }

    public static function findById($id) {
        $users = self::getAll();
        foreach ($users as $user) {
            if ($user['id'] == $id) return $user;
        }
        return null;
    }

    public static function create($data) {
        $users = self::getAll();
        $data['id'] = count($users) > 0 ? end($users)['id'] + 1 : 1;
        $users[] = $data;
        self::saveAll($users);
        return $data;
    }

    public static function update($id, $data) {
        $users = self::getAll();
        foreach ($users as &$user) {
            if ($user['id'] == $id) {
                $user = array_merge($user, $data);
                self::saveAll($users);
                return $user;
            }
        }
        return null;
    }

    public static function delete($id) {
        $users = self::getAll();
        $newUsers = array_filter($users, fn($u) => $u['id'] != $id);
        self::saveAll(array_values($newUsers));
    }
}
?>