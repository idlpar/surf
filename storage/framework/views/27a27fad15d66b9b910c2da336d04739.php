<ul class="account-nav">
    <li><a href="<?php echo e(route('user.dashboard')); ?>" class="menu-link menu-link_us-s">Dashboard</a></li>
    <li><a href="account-orders.html" class="menu-link menu-link_us-s">Orders</a></li>
    <li><a href="account-address.html" class="menu-link menu-link_us-s">Addresses</a></li>
    <li><a href="account-details.html" class="menu-link menu-link_us-s">Account Details</a></li>
    <li><a href="account-wishlist.html" class="menu-link menu-link_us-s">Wishlist</a></li>
    <form method="POST" action="<?php echo e(route('logout')); ?>" id="logout-form" style="display: none;">
        <?php echo csrf_field(); ?>
    </form>
    <li><a href="logout" class="menu-link menu-link_us-s" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a></li>
</ul>
<?php /**PATH D:\e-commerce\tarpor\resources\views/user/account-nav.blade.php ENDPATH**/ ?>