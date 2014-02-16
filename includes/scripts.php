<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js'></script>

<?php if($_SERVER['SERVER_NAME'] == 'cell.dev'): ?>
    <script src='/js/respond.min.js'></script>
<?php else: ?>
    <script src='/build/scripts.min.js'></script>
<?php endif; ?>

<?php if($newEnv): ?>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src='https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false'></script>
    <script src='/js/new-env.js'></script>
<?php endif; ?>