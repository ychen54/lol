<div class="container pull-left" style="width: 300px;margin-left: 10%; height: auto;"> 
            <div class="list-group">
                <a href="#" style="font-weight: bolder;" class="list-group-item list-group-item-info">
                    Admin Page
                </a>
                <a href="/lol/admin/index" class="list-group-item active">My Articles</a>
                <a href="/lol/admin/password" class="list-group-item">Update Password</a>
                <?php if($_SESSION['type'] == 'admin'): ?>
                    <a href="#" class="list-group-item">Comments List</a>
                    <a href="#" class="list-group-item">Users List</a>
                <?php endif; ?>
            </div>

        </div>