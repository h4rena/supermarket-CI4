    </main>
  </div>
</div>

<script>
  const toggle = document.getElementById('menuToggle');
  const sidebar = document.getElementById('sidebar');
  if (toggle) {
    toggle.addEventListener('click', () => sidebar.classList.toggle('open'));
  }
</script>

</body>
</html>
