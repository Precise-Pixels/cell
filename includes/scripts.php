<?php if($_SERVER['SERVER_NAME'] == 'cell.dev'): ?>
    <script src='/js/respond.min.js'></script>
    <script src='/js/page-home.js'></script>
    <script src='/js/timeline-scroll.js'></script>
<?php else: ?>
    <script src='/build/scripts.min.js'></script>
<?php endif; ?>