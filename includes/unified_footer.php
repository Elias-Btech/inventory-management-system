        </div><!-- /.page-content -->
    </div><!-- /.main-content -->
</div><!-- /.layout -->

<script src="../assets/js/script.js"></script>
<script>
// Load notification count on page load
(function() {
    fetch('../api/get_notifications.php?count_only=1')
        .then(r => r.json())
        .then(data => {
            const badge = document.getElementById('notifCount');
            if (badge && data.count > 0) {
                badge.textContent = data.count;
                badge.style.display = 'flex';
            }
        })
        .catch(() => {});
})();
</script>
<footer style="text-align:center; padding: 15px; color: rgba(255,255,255,0.5); font-size:0.8rem;">
    &copy; <?php echo date('Y'); ?> StockWise Pro &mdash; Inventory Management System
</footer>
</body>
</html>
