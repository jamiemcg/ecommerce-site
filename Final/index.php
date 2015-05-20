<?php
    include('header.php');
?>
<div id="main_body">
    <!-- Create a 2x2 grid -->
    <div class="wrapper">
        <div class="row">
            <div class="col_1_2">
                <!-- the left column - mens -->
                <a href="category.php?cat=9">
                <h2>
                    Mens
                </h2><img src="img/mens_shoes.png"></a>
            </div>
            <div class="col_1_2">
                <!-- the right column - women -->
                <a href="category.php?cat=10">
                <h2>
                    Womens
                </h2><img src="img/womens_shoes.png"></a>
            </div>
        </div>
        <!-- new row for kids shoes -->
        <div class="row">
            <div class="col_1_2">
                <!-- the left column - boys -->
                <a href="category.php?cat=7">
                <h2>
                    Boys
                </h2><img src="img/boys_shoes.png"></a>
            </div>
            <div class="col_1_2">
                <!-- the right column - girls -->
                <a href="category.php?cat=8">
                <h2>
                    Girls
                </h2><img src="img/girls_shoes.png"></a>
            </div>
        </div>
    </div>
</div>
<?php
    include('footer.php');
?>