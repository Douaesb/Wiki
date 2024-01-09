<?php
require_once('../controller/usercontroller.php');

$user = new usercontroller();
$err =$user->Register();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Wiki™</title>
</head>

<body>
    <section>

        <!-- component -->

        <div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12" id="signform">
            <div class="relative py-3 sm:max-w-xl sm:mx-auto">
                <div class="absolute inset-0 bg-gradient-to-l from-gray-100 via-gray-200 to-gray-300 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl">
                </div>
                <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
                    <div class="max-w-md mx-auto">
                        <form action="" method="post" >
                            <?php if (!empty($err)) : ?>
                                <div class="text-xl font-semibold text-red-500">
                                    <?php echo $err; ?>
                                </div>
                            <?php endif; ?>
                            <div>
                                <h1 class="text-2xl font-semibold">Sign Up <br> Create your own Wikis </h1>
                            </div>

                            <div class="divide-y divide-gray-200">
                                <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                                    <div class="relative">
                                        <input autocomplete="off" id="surname" name="nom" type="text" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Enter your surname" required/>
                                        <span class="text-sm" type="text" name="" id="regsurname"></span>
                                        <label for="" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Enter your surname</label>
                                    </div>
                                    <div class="relative">
                                        <input autocomplete="off" id="username" name="prenom" type="text" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Enter your username" required/>
                                        <span class="text-sm" type="text" name="" id="regusername"></span>

                                        <label for="" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Enter your username</label>
                                    </div>
                                    <div class="relative">
                                        <input autocomplete="off" id="email" name="email" type="email" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Email address" required/>
                                        <span class="text-sm" type="text" name="" id="regemail"></span>
                                        <label for="" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Email Address</label>
                                    </div>
                                    <div class="relative">
                                        <input autocomplete="off" id="tel" name="tel" type="text" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Enter your phone number" required />
                                        <span class="text-sm" type="text" name="" id="regtel"></span>
                                        <label for="" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Enter your phone number</label>
                                    </div>
                                    <div class="relative">
                                        <input autocomplete="off" id="pass" name="pass" type="password" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Password" required/>
                                        <span class="text-sm" type="text" id="rpassword"></span>
                                        <label for="" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Password</label>
                                    </div>
                                    <div class="relative">
                                        <button name="submit" type="submit" id="submitBtn" class="bg-gray-400 text-white rounded-md px-2 py-1">Create Account</button>
                                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                                        already have an account? <a href="login.php" class="font-medium text-gray-600  hover:underline">Login to your account </a>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
    const surname = document.getElementById('surname');
    const regsurname = document.getElementById('regsurname');
    const username = document.getElementById('username');
    const regusername = document.getElementById('regusername');
    const tel = document.getElementById('tel');
    const regtel = document.getElementById('regtel');
    const email = document.getElementById('email');
    const regemail = document.getElementById('regemail');
    const password = document.getElementById('pass');
    const rpassword = document.getElementById('rpassword');
    const submitBtn = document.getElementById('submitBtn');

    const validsurname = /^[a-zA-Z]{3,}$/;
    const validusername = /^[a-zA-Z]{3,}$/;
    const validemail = /^(([a-zA-Z]{1,})\d{1,}@[a-z]{1,}\.[a-z]{1,3}|[a-z]+@[a-z]+\.[a-z]{1,3})$/;
    const validtel = /^\d{10}$/;
    const validpass = /^.{8,}$/;

    const isFormValid = () => validsurname.test(surname.value)
        && validusername.test(username.value)
        && validemail.test(email.value)
        && validtel.test(tel.value)
        && validpass.test(password.value);

    const updateButtonColor = () => {
        submitBtn.style.backgroundColor = isFormValid() ? 'green' : 'red';
    };

    submitBtn.disabled = !isFormValid();

    const updateValidity = (field, validation, errorElement, comment) => {
        const inputValue = field.value;
        if (validation.test(inputValue)) {
            errorElement.innerText = `${field.name} is Valid`;
            errorElement.style.color = 'green';
            errorElement.style.display = 'block';
        } else {
            errorElement.innerText = comment; 
            errorElement.style.color = 'red';
            errorElement.style.display = 'block';
        }
        submitBtn.disabled = !isFormValid(); 
        updateButtonColor();
    };

    surname.addEventListener('input', () => updateValidity(surname, validsurname, regsurname, 'at least 3 characters'));
    username.addEventListener('input', () => updateValidity(username, validusername, regusername, 'at least 3 characters'));
    email.addEventListener('input', () => updateValidity(email, validemail, regemail, 'Invalid email address'));
    tel.addEventListener('input', () => updateValidity(tel, validtel, regtel, 'Enter 10 digits'));
    password.addEventListener('input', () => updateValidity(password, validpass, rpassword, 'at least 8 characters'));
</script>


</body>

</html>