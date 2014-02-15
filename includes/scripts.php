<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js'></script>

<?php if($_SERVER['SERVER_NAME'] == 'cell.dev'): ?>
    <script src='/js/respond.min.js'></script>
    <script src='/js/page-home.js'></script>
<?php else: ?>
    <script src='/build/scripts.min.js'></script>
<?php endif; ?>