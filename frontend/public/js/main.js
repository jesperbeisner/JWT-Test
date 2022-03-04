const loginButton = document.getElementById('login-button');
loginButton.addEventListener('click', () => {
  const username = document.getElementById('username').value;
  const password = document.getElementById('password').value;

  const data = {
    "username": username,
    "password": password
  };

  fetch('http://localhost:8080/auth', {
    method: 'POST',
    credentials: 'include',
    body: JSON.stringify(data),
  })
    .then(response => response.json())
    .then(data => {
      showInfo('Login successful');
    })
    .catch((error) => {
      console.error('Error:', error);
    });
});


const logoutButton = document.getElementById('logout-button');
logoutButton.addEventListener('click', () => {
  fetch('http://localhost:8080/logout', {
    credentials: 'include',
  })
    .then(response => response.json())
    .then(data => {
      showInfo('Logout successful');
    })
    .catch((error) => {
      console.error('Error:', error);
    });
});

const usersButton = document.getElementById('users-button');
usersButton.addEventListener('click', () => {
  fetch('http://localhost:8080/users', {
    credentials: 'include',
  })
    .then(response => {
      if (response.status === 401) {
        throw new Error('401 - Not logged in');
      }

      return response.json();
    })
    .then(data => {
      // TODO: Display users and errors...
      showInfo('Get users worked!');
      console.log(data);
    })
    .catch((error) => {
      showInfo(error.message);
    });
});

const showInfo = (text) => {
  const infoAlertText = document.getElementById('info-alert-text');
  infoAlertText.innerText = text;

  const infoAlert = document.getElementById('info-alert');
  infoAlert.classList.remove('d-none');

  setTimeout(() => {
    infoAlert.classList.add('d-none');
    infoAlertText.innerText = 'Info alert placeholder';
  }, 3000);
}