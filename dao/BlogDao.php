<?php
/**
 * Description of BookingDao
 *
 */
class BlogDao {
    
    private $db = null;
    
    public function __destruct() {
        $this->db = null;
    }


    public function find($sql) {
        $result = array();
        foreach ($this->query($sql) as $row) {
            $blog = new Blog();
            BlogMapper::map($blog, $row);
            //$result[$blog->getId()] = $blog;
            $result[] = $blog;
        }

        return $result;
    }

    public function findById($id) {
        $row = $this->query('SELECT * FROM blogs WHERE status != "deleted" and id = ' . (int) $id)->fetch();
        if (!$row) {
            return null;
        }
        $blog = new Blog();
        BlogMapper::map($blog, $row);
        return $blog;
    }

    public function save(Blog $blog) {
        if ($blog->getId() === null) {
            return $this->insert($blog);
        }
        return $this->update($blog);
    }

    public function delete($id) {
        $sql = '
            UPDATE blogs SET
                status = :status
            WHERE
                id = :id';
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, array(
            ':status' => 'deleted',
            ':id' => $id,
        ));
        return $statement->rowCount() == 1;
    }

    private function getDb() {
        if ($this->db !== null) {
            return $this->db;
        }
        $config = Config::getConfig("db");
        try {
            $this->db = new PDO($config['dsn'], $config['username'], $config['password']);
        } catch (Exception $ex) {
            throw new Exception('DB connection error: ' . $ex->getMessage());
        }
        return $this->db;
    }
    

    private function insert(Blog $blog) {
        $blog->setId(null);
        $blog->setStatus('pending');
        $blog->setUserId(1);
        $sql = '
            INSERT INTO blogs (id, title, description, content, status, user_id)
                VALUES (:id, :title, :description, :content, :status, :user_id)';
        return $this->execute($sql, $blog);
    }


    private function update(Blog $blog) {
        
        $sql = '
            UPDATE blogs SET
                title = :title,
                description = :description,
                content = :content,
                status = :status,
                user_id = :user_id
            WHERE
                id = :id';
        
        return $this->execute($sql, $blog);
    }

    
    private function execute($sql, Blog $blog) {
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, $this->getParams($blog));
        if (!$blog->getId()) {
            return $this->findById($this->getDb()->lastInsertId());
        }
//        if (!$statement->rowCount()) {
//            throw new NotFoundException('Booking with ID "' . $blog->getId() . '" does not exist.');
//        }
        return $blog;
    }
    private function getParams(Blog $blog) {
        // :id, :title, :description, :content, :user_id
        $params = array(
            ':id' => $blog->getId(),
            ':title' => $blog->getTitle(),
            ':description' => $blog->getDescription(),
            ':content' => $blog->getContent(),
            ':status' =>$blog->getStatus(),
            ':user_id' => $blog->getUserId()
                
        );

        return $params;
    }
    private function executeStatement(PDOStatement $statement, array $params) {
        if (!$statement->execute($params)) {
            self::throwDbError($this->getDb()->errorInfo());
        }
    }

    private function query($sql) {
        $statement = $this->getDb()->query($sql, PDO::FETCH_ASSOC);
        if ($statement === false) {
            self::throwDbError($this->getDb()->errorInfo());
        }
        return $statement;
    }
    private static function throwDbError(array $errorInfo) {
        // TODO log error, send email, etc.
        throw new Exception('DB error [' . $errorInfo[0] . ', ' . $errorInfo[1] . ']: ' . $errorInfo[2]);
    }
    private static function formatDateTime(DateTime $date) {
        return $date->format(DateTime::ISO8601);
    }
}