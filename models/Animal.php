<?php

namespace models;

/**
 * Contain methods for storing animals in database. GET|UPDATE|INSERT options
 * @author Krasimir Kostadinov
 */
class Animal {

    /**
     * Properties from XML element
     */
    private $id = null,
            $_category = '',
            $_subcategory = '',
            $_name = '',
            $_description = '',
            $_eat = '',
            $_date_created = null;
    protected static $db;

    public function __construct($id = null) {
        self::$db = new \models\Database();

        $id = (int)$id;
        if (!empty($id)) {
            $this->init($id);
        }
    }

    /**
     * Method for object initialisation
     * @param int $id
     */
    public function init($id) {
        $this->id = (int) $id;
        if (!empty($this->id)) {
            $sql = '
                SELECT a.* FROM animals AS a
                WHERE a.id = :id
            ';
            $params = array('id' => $this->id);

            $num_rows = self::$db->prepare($sql, $params)->execute()->getAffectedRows();
            if ($num_rows === 1) {
                $rows = self::$db->fetchAllAssoc();
                $animal = self::createAnimalsObjects($rows);
                if (count($animal) === 1) {
                    $k = key($animal);
                    if ($animal[$k] instanceof \models\Animal) {
                        $this->id = $animal[$k]->id;
                        $this->_category = $animal[$k]->_category;
                        $this->_subcategory = $animal[$k]->_subcategory;
                        $this->_name = $animal[$k]->_name;
                        $this->_description = $animal[$k]->_description;
                        $this->_eat = $animal[$k]->_eat;
                        $this->_date_created = $animal[$k]->_date_created;
                    }
                }
            }
            else {
                throw new \Exception('Animal with ID [' . $id . '] not exist!');
            }
        }
    }

    /**
     * Create \models\Animal object from assoc array
     * @param array $rows assoc with keys name of fields
     * @return \models\Animal|null
     */
    public static function createAnimalsObjects($rows) {
        if (!empty($rows) && is_array($rows)) {
            foreach ($rows as $row) {
                $key = $row['id'];
                $animal[$key] = new \models\Animal();
                $animal[$key]->id = $row['id'];
                $animal[$key]->_category = $row['category'];
                $animal[$key]->_subcategory = $row['subcategory'];
                $animal[$key]->_name = $row['name'];
                $animal[$key]->_description = $row['description'];
                $animal[$key]->_eat = $row['eat'];
                $animal[$key]->_date_created = $row['date_created'];
            }
            return !empty($animal) ? $animal : null;
        }
        return null;
    }

    /**
     * Get animals from DB by given parameters
     * @param array $params for query of type $key => $value
     * @param string $name => animal name
     * @param string $category => animal category
     * @param string $date_created => date created of row
     * @param bool $return_as_array
     * @return \models\Animals | array
     */
    public static function getAnimals($params = array(), $return_as_array = false) {
        $db = new \models\Database();

        $sql = $order = $limit = $select_init = ' ';
        $where = ' WHERE 1  ';
        $values = array();

        if (!empty($params) && is_array($params)) {
            if (isset($params['sql'])) {
                $sql .= ' ' . $params['sql'] . ' ';
            }
            if (isset($params['where'])) {
                $where .= ' ' . $params['where'] . ' ';
            }
            if (isset($params['values']) && is_array($params['values'])) {
                foreach ($params['values'] as $k => $v) {
                    $values[$k] = $v;
                }
            }
            if (isset($params['id'])) {
                $where .= ' AND a.id = :id ';
                $values['id'] = $params['id'];
            }
            if (isset($params['name'])) {
                $where .= ' AND a.name = :name ';
                $values['name'] = $params['name'];
            }
            if (isset($params['search_name'])) {
                $where .= ' AND LOWER(a.name) LIKE LOWER(:name) ';
                $values['name'] = '%'.$params['search_name'].'%';
            }
            if (isset($params['category'])) {
                $where .= ' AND a.category = :category ';
                $values['category'] = $params['category'];
            }
            if (isset($params['subcategory'])) {
                $where .= ' AND a.subcategory = :subcategory ';
                $values['subcategory'] = $params['subcategory'];
            }
            if (isset($params['eat'])) {
                $where .= ' AND a.eat = :eat ';
                $values['eat'] = $params['eat'];
            }
            if (isset($params['date_created'])) {
                $where .= ' AND a.date_created = :date_created ';
                $values['date_created'] = $params['date_created'];
            }

            if (isset($params['order'])) {
                $order = ' ORDER BY ' . $params['order'] . ' ';
            }
            if (isset($params['limit'])) {
                $limit = ' LIMIT ' . $params['limit'] . ' ';
            }
        }

        $query = 'SELECT a.*
                FROM animals AS a ' .
                $sql . $where . $order . $limit . '
            ';

        $db->prepare($query, $values)->execute();
        $rows = $db->fetchAllAssoc();
        if (!$return_as_array) {
            $animals = self::createAnimalsObjects($rows);
            return $animals;
        }
        else {
            return $rows;
        }
    }

    /**
     * Save or update animals data
     */
    public function save() {
        $dateNow = date('Y-m-d H:i:s', time());
        $this->id = (int) $this->id;
        
        if (!empty($this->id)) {
            //update case
            if ($this->_update()) {
                return true;
            }
        }
        else {
            //Insert case
            if ($this->_insert()) {
                return true;
            }
        }
    }

    private function _insert() {
        $dateNow = date('Y-m-d H:i:s', time());
        $sql = '
                INSERT INTO animals (category, subcategory, name, description, eat, date_created)
                VALUES (:category, :subcategory, :name, :description, :eat, :date_created) ';
        $params = array(
            'category' => $this->_category,
            'subcategory' => $this->_subcategory,
            'name' => $this->_name,
            'description' => $this->_description,
            'eat' => $this->_eat,
            'date_created' => $dateNow
        );
        self::$db->prepare($sql, $params)->execute();
        if (self::$db->getAffectedRows() > 0) {
            $this->id = self::$db->getLastInsertId();
            $animal = new \models\Animal($this->id);
            if ($animal->setId($this->id)->save()) {
                return true;
            }
        }
    }

    private function _update() {
        $dateNow = date('Y-m-d H:i:s', time());
        $sql = '
                UPDATE animals
                SET name = :name,
                    category = :category,
                    subcategory = :subcategory,
                    eat = :eat,
                    description = :description,
                    date_created = :date_created
                WHERE id = :id
            ';
        
        $params = array(
            'id' => $this->id,
            'category' => $this->_category,
            'subcategory' => $this->_subcategory,
            'name' => $this->_name,
            'description' => $this->_description,
            'eat' => $this->_eat,
            'date_created' => $dateNow
        );
        self::$db->prepare($sql, $params)->execute();
        if (self::$db->getAffectedRows() > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * get id of animal
     * @return int
     */
    public function getId() {
        return (int) $this->id;
    }

    /**
     * get category of animal
     * @return string
     */
    public function getCategory() {
        return \models\Database::validateData($this->_category, 'string|specialchars|strip_tags');
    }

    /**
     * get subcategory of animal
     * @return string
     */
    public function getSubcategory() {
        return \models\Database::validateData($this->_subcategory, 'string|specialchars|strip_tags');
    }

    /**
     * Get name of animal
     * @return string
     */
    public function getName() {
        return \models\Database::validateData($this->_name, 'string|specialchars|strip_tags');
    }

    /**
     * Get description for the animal
     * @return string
     */
    public function getDescription() {
        return \models\Database::validateData($this->_description, 'string|specialchars|strip_tags');
    }

    /**
     * get what eat
     * @return string
     */
    public function getEat() {
        return \models\Database::validateData($this->_eat, 'string|specialchars|strip_tags');
    }

    /**
     * Get date when row is created
     * @return string
     */
    public function getDateCreated() {
        return $this->_date_created;
    }

    public function setId($id) {
        $this->id = (int) $id;
        return $this;
    }

    public function setCategory($_category) {
        $this->_category = $_category;
        return $this;
    }

    public function setSubcategory($_subcategory) {
        $this->_subcategory = $_subcategory;
        return $this;
    }

    public function setName($_name) {
        $this->_name = $_name;
        return $this;
    }

    public function setDescription($_description) {
        $this->_description = $_description;
        return $this;
    }

    public function setEat($_eat) {
        $this->_eat = $_eat;
        return $this;
    }

    public function setDateCreated($_date_created) {
        $this->_date_created = $_date_created;
        return $this;
    }
}
