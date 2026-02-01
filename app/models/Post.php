<?php
class Post {
    private $pdo;
    public function __construct($pdo){ $this->pdo = $pdo; }

    public function create($user_id,$title,$content){
        $stmt = $this->pdo->prepare("INSERT INTO posts (user_id,title,content,created_at) VALUES (:user_id,:title,:content,NOW())");
        $stmt->execute(['user_id'=>$user_id,'title'=>$title,'content'=>$content]);
    }

    public function getAll(){
        return $this->pdo->query("SELECT posts.*, users.name AS author FROM posts JOIN users ON posts.user_id=users.id ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByUser($user_id){
        $stmt = $this->pdo->prepare("SELECT * FROM posts WHERE user_id=:user_id ORDER BY created_at DESC");
        $stmt->execute(['user_id'=>$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get($id,$user_id){
        $stmt = $this->pdo->prepare("SELECT * FROM posts WHERE id=:id AND user_id=:user_id");
        $stmt->execute(['id'=>$id,'user_id'=>$user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id,$user_id,$title,$content){
        $stmt = $this->pdo->prepare("UPDATE posts SET title=:title, content=:content WHERE id=:id AND user_id=:user_id");
        $stmt->execute(['title'=>$title,'content'=>$content,'id'=>$id,'user_id'=>$user_id]);
    }

    public function delete($id,$user_id){
        $stmt = $this->pdo->prepare("DELETE FROM posts WHERE id=:id AND user_id=:user_id");
        $stmt->execute(['id'=>$id,'user_id'=>$user_id]);
    }
}
?>
