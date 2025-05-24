document.addEventListener('DOMContentLoaded', () => {
  const toggleButton = document.getElementById('changeDarkMode');

  if (localStorage.getItem('darkMode') === 'enabled') {
    document.body.classList.add('dark-mode');
  }

  toggleButton.addEventListener('click', () => {
    document.body.classList.toggle('dark-mode');

    if (document.body.classList.contains('dark-mode')) {
      localStorage.setItem('darkMode', 'enabled');
      toggleButton.textContent = 'Toggle Website Light Mode';
    } else {
      localStorage.setItem('darkMode', 'disabled');
      toggleButton.textContent = 'Toggle Website Dark Mode';
    }
  });

  if (document.body.classList.contains('dark-mode')) {
    toggleButton.textContent = 'Toggle Website Light Mode';
  } else {
    toggleButton.textContent = 'Toggle Website Dark Mode';
  }
});