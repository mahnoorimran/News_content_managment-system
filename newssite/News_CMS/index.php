<?php include 'header.php'; 
include "config.php";
 ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                <div class="post-container"><!-- post-container -->
                    <?php
                        include 'config.php';
                          $limit=3;
                          if(isset($_GET['page'])){
                            $page=$_GET['page'];
                            }else{
                                $page=1;
                                }
                                             
                        $offset=($page-1)*$limit;
                        $sql="select * from post left join category on post.category=category.category_id left join user on post.author=user.user_id order by post.post_id limit $offset,$limit";
                        $result=mysqli_query($link,$sql);
                        while($row=mysqli_fetch_assoc($result)){?>

                        <div class="post-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?postid=<?php echo $row['post_id']?>"><img src="admin/upload/<?php echo $row['post_img']?>" alt=""/></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href="single.php?postid=<?php echo $row['post_id']?>"><?php echo $row['title']?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href="category.php?catid=<?php echo $row['category_id']?>"><?php echo $row['category_name']?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href="author.php?authid=<?php echo $row['user_id']?>"><?php echo $row['username']?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?php echo $row['post_date']?>
                                            </span>
                                        </div>
                                        <p class="description">
                                        <?php echo substr($row['description'],0,110)."...."?>
                                        </p>
                                        <a class='read-more pull-right' href="single.php?postid=<?php echo $row['post_id']?>">read more</a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /post-content -->
                        <?php }
                  $sql="select * from post";
                  $result=mysqli_query($link,$sql);
                  $total=mysqli_num_rows($result);
                  $limit=3;
                  $totalpages=ceil($total/$limit);
                  echo"<ul class='pagination admin-pagination'>";
                    
                    for($i = 1;$i <= $totalpages;$i++)

                    {
                        if($i==$page){
                            $active="active";
                
                        }else{

                            $active="";
                        }
                        echo '<li class="'.$active.'"><a href="index.php? page='.$i.'">'.$i.'</a></li>';
                    }
                      
                  echo'</ul>';
                  ?>
                </div><!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
