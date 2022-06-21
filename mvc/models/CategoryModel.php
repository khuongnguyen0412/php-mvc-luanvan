<?php
class categoryModel
{
    private static $instance = null;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new categoryModel();
        }

        return self::$instance;
    }

    public function getAllClient()
    {
        $db = dB::getInstance();
        $sql = "SELECT * FROM categories WHERE status=1";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }

    public function getAllAdmin($page = 1, $total = 8)
    {
        if ($page <= 0) {
            $page = 1;
        }
        $tmp = ($page - 1) * $total;
        $db = dB::getInstance();
        $sql = "SELECT * FROM categories LIMIT $tmp,$total";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }

    public function getById($Id)
    {
        $db = dB::getInstance();
        $sql = "SELECT * FROM categories WHERE Id='$Id' AND status=1";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }

    public function getByIdAdmin($Id)
    {
        $db = dB::getInstance();
        $sql = "SELECT * FROM categories WHERE Id='$Id'";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }

    public function changeStatus($Id)
    {
        $db = dB::getInstance();
        $sql = "UPDATE categories SET status = !status WHERE Id='$Id'";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }

    public function insert($name)
    {
        $db = dB::getInstance();
        $sql = "INSERT INTO categories VALUES (NULL, '$name',1)";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }

    public function update($id, $name)
    {
        $db = dB::getInstance();
        $sql = "UPDATE categories SET name = '" . $name . "' WHERE id=" . $id;
        $result = mysqli_query($db->con, $sql);
        return $result;
    }

    public function getCountPaging($row = 8)
    {
        $db = dB::getInstance();
        $sql = "SELECT COUNT(*) FROM categories";
        $result = mysqli_query($db->con, $sql);
        if ($result) {
            $totalrow = intval((mysqli_fetch_all($result, MYSQLI_ASSOC)[0])['COUNT(*)']);
            return ceil($totalrow / $row);
        }
        return false;
    }
}
