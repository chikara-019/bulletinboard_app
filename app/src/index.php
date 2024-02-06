<?php

    require_once 'database.php';
    require_once 'functions.php';
    require_once 'post.php';
    require_once 'data.php';


    date_default_timezone_set("Asia/Tokyo");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP掲示板</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1 class="title">掲示板</h1>
    <hr>
    <form class="formWrapper" method="POST">
            <div>
                <input type="submit" value="投稿する" name="submitButton">
            </div>
            <div>
                <lable for="username">名前：</label>
                <input type="text" name="username">
            </div>
            <!--requiredでの入力制限かけること可能-->
            <div>
                <lable for="title">タイトル：</label>
                <input type="text" name="title">
            </div>

            <div>
                <label for="comment">コメント：</label>

                <textarea class="commentTextArea" name="comment"></textarea>
                <p><input type="reset" value="入力内容消去" name="reset"></p>
            </div>

    
    </form>        <!--requiredでの入力制限かけること可能-->
    <div class="boardWrapper">
        <section>
            <?php foreach($comments as $data): ?>
                <article>
                    <div class="wapper">
                        <div class="nameArea">
                            <span>名前：</span>
                            <p class="username"><?php echo str2html($data["username"]); ?></p>

                            <span>タイトル：</span>

                            <p class="username"><?php echo str2html($data["title"]); ?></p>
                            <time>:<?php echo $data["postdate"]; ?></time>
                            
                        </div>
                        <p class="comment"><?php echo str2html($data["comment"]); ?></p>

                    
                        <div>
                            <form method="POST" action="delete.php">
                                <input type="hidden" name="deletebutton" value="<?php echo $data['id']; ?>">
                                <input type="submit" value="削除ボタン">
                            </form>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>

        </section>
        <div>
            <?php require_once 'page.php'; ?>
        </div>
                
    </div>   
</body>
</html>


