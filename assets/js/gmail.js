  window.onload = function () {
    google.accounts.id.initialize({
      client_id: 'YOUR_CLIENT_ID.apps.googleusercontent.com',
      callback: handleCredentialResponse,
      auto_select: true,
      prompt_parent_id: 'container', // Replace 'container' with the ID of the parent element where you want the sign-in prompt to appear
      cancel_on_tap_outside: false,
      state_cookie_domain: 'localhost', // Replace with your domain
      native_callback: function (response) {
        console.log(response);
      },
      supported_auth_methods: ['https://accounts.google.com'],
      context: 'signin',
    });
    google.accounts.id.renderButton(
      document.getElementById('signinButton'),
      {
        theme: '',
        size: 'large',
        text: 'continue_with',
        shape: 'rectangular',
        width: '300px',
        height: '60px',
      }
    );
  };

  function handleCredentialResponse(response) {
    console.log(response);
  }
