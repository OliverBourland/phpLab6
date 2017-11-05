<?php
class CategoryDB {
    public static function getCategories() {
        $db = Database::getDB();
        $query = 'SELECT * FROM categories
                  ORDER BY categoryID';
        $statement = $db->prepare($query);
        $statement->execute();
        
        $categories = array();
        foreach ($statement as $row) {
            $category = new Category($row['categoryID'],
                                     $row['categoryName']);
            $categories[] = $category;
        }
        return $categories;
    }

    public static function getCategory($category_id) {
        $db = Database::getDB();
        $query = 'SELECT * FROM categories
                  WHERE categoryID = :category_id';    
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();    
        $row = $statement->fetch();
        $statement->closeCursor();    
        $category = new Category($row['categoryID'],
                                 $row['categoryName']);
        return $category;
    }

    public static function add_category($category_name) {
        $db = Database::getDB();
        $query = 'INSERT INTO categories
                 (categoryName)
              VALUES
                 (:category_name)';
        $statement = $db->prepare($query);
        $statement->bindValue(':category_name', $category_name);
        $statement->execute();
        $statement->closeCursor();
}

    public static function delete_category($category_id) {
        $db = Database::getDB();
        $query = 'DELETE FROM categories
              WHERE categoryID = :category_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();
        $statement->closeCursor();
}

public static function getCategoryID($category_name) {
        $db = Database::getDB();
        $query = 'SELECT * FROM categories
                  WHERE categoryName = :category_name';    
        $statement = $db->prepare($query);
        $statement->bindValue(':category_name', $category_name);
        $statement->execute();    
        $row = $statement->fetch();
        $statement->closeCursor();    
        $category = $row['categoryID'];
        return $category;
         
    }

}
?>