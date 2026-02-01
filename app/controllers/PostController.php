<?php
require_once '../config/db.php';
require_once '../app/models/Post.php';

class PostController {
    private $post;
    public function __construct($pdo){ $this->post = new Post($pdo); }

    public function dashboard(){
        session_start();
        if(!isset($_SESSION['user_id'])) header("Location: ../public/index.php");

        $user_id = $_SESSION['user_id'];
        $section = $_GET['section'] ?? 'all';

        $all_posts = $this->post->getAll();
        $my_posts = $this->post->getByUser($user_id);

        require '../app/views/dashboard.php';
    }

    public function create(){
        session_start();
        if(!isset($_SESSION['user_id'])) header("Location: ../public/index.php");

        if($_SERVER['REQUEST_METHOD']==='POST'){
            $title = htmlspecialchars($_POST['title']);
            $content = htmlspecialchars($_POST['content']);
            if($title && $content){
                $this->post->create($_SESSION['user_id'],$title,$content);
                header("Location: dashboard.php?section=my");
            } else $error="All fields required!";
        }
        require '../app/views/post_form.php';
    }

    public function edit(){
        session_start();
        if(!isset($_SESSION['user_id'])) header("Location: ../public/index.php");

        $id = $_GET['id'] ?? 0;
        $post = $this->post->get($id,$_SESSION['user_id']);
        if(!$post) die("Post not found");

        if($_SERVER['REQUEST_METHOD']==='POST'){
            $title = htmlspecialchars($_POST['title']);
            $content = htmlspecialchars($_POST['content']);
            if($title && $content){
                $this->post->update($id,$_SESSION['user_id'],$title,$content);
                header("Location: dashboard.php?section=my");
            } else $error="All fields required!";
        }
        require '../app/views/post_form.php';
    }

    public function delete(){
        session_start();
        if(!isset($_SESSION['user_id'])) header("Location: ../public/index.php");

        $id = $_GET['id'] ?? 0;
        $this->post->delete($id,$_SESSION['user_id']);
        header("Location: dashboard.php?section=my");
    }
}
?>
