<div class="container pull-left" style="width: 200px;margin-left: 10%; height: auto;"> 
            <div class="list-group">
                <a href="#" style="font-weight: bolder;" class="list-group-item list-group-item-info">
                    Admin Page
                </a>
                <a href="/lol/admin/index" id="articlenav" class="list-group-item">My Articles</a>
                <a href="/lol/admin/comments" id="commentnav" class="list-group-item">Comments List</a>
                <?php if($_SESSION['type'] == 'admin'): ?>
                    <a href="/lol/super/users" id="usernav" class="list-group-item">Users List</a>
                <?php endif; ?>
            </div>

        </div>