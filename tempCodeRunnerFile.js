function register() {
    const fullName = document.getElementById('fullNameInput').value;
    const username = document.getElementById('usernameInput').value;
    const email = document.getElementById('emailInput').value;
    const password = document.getElementById('passwordInput').value;

    console.log('Full Name:', fullName);
    console.log('Username:', username);
    console.log('E-mail:', email);
    console.log('Password:', password);

    // Close the form after registration
    closeRegisterForm();
}

function signIn() {
    const email = document.getElementById('emailInput').value;
    const password = document.getElementById('passwordInput').value;

    console.log('Email:', email);
    console.log('Password:', password);

    // Close the form after sign in
    closeRegisterForm();
}

function openRegisterForm() {
    const formOverlay = document.querySelector('.form-overlay');
    const formOption = document.getElementById('formOption');
    const fullNameInput = document.getElementById('fullNameInput');
    const usernameInput = document.getElementById('usernameInput');
    const signinButton = document.getElementById('signinButton');

    formOverlay.style.display = 'flex';
    formOption.textContent = 'Register';
    fullNameInput.style.display = 'block';
    usernameInput.style.display = 'block';
    signinButton.style.display = 'none';

    // Update mode variables
    isRegisterMode = true;
    isSignInMode = false;
}

function openSignInForm() {
    const formOverlay = document.querySelector('.form-overlay');
    const formOption = document.getElementById('formOption');
    const fullNameInput = document.getElementById('fullNameInput');
    const usernameInput = document.getElementById('usernameInput');
    const registerButton = document.getElementById('registerButton');

    formOverlay.style.display = 'flex';
    formOption.textContent = 'Sign In';
    fullNameInput.style.display = 'none'; // Hide Full Name input for Sign In
    usernameInput.style.display = 'none';
    registerButton.style.display = 'none';
    // Update mode variables
    isRegisterMode = false;
    isSignInMode = true;
}

function closeRegisterForm() {
    const formOverlay = document.querySelector('.form-overlay');
    const signinButton = document.getElementById('signinButton');
    const registerButton = document.getElementById('registerButton');

    formOverlay.style.display = 'none';
    
    // Reset the display style of buttons to 'block' عشان لما اليوزر يفتح تاني الفورم يلاقي الزرار موجود
    signinButton.style.display = 'block';
    registerButton.style.display = 'block';
}

function preventClosingForm(event) {
    event.stopPropagation(); // Prevents clicks inside the form from closing the overlay
}