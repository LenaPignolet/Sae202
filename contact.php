<?php
require('header.php');
require('menu.php');
?>
<body>
    
    <section class="bg-white dark:bg-white">
    <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
        <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900">Contactez Nous</h2>
        <p class="mb-8 lg:mb-16 font-light text-center text-gray-500 sm:text-xl">Besoin d'aide ou de plus d'informations ? N'hésitez pas à nous contacter. </p>
        <form action="../auth/envoi_mail.php" method="POST" class="space-y-8">
    <div>
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Votre mail</label>
        <input type="email" id="email" name="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" placeholder="nom@exemple.com" required>
    </div>
    <div>
        <label for="subject" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Sujet</label>
        <input type="text" id="subject" name="subject" class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500" placeholder="Besoin d'aide" required>
    </div>
    <div class="sm:col-span-2">
        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Ton message</label>
        <textarea id="message" name="message" rows="6" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg shadow-sm border border-gray-300 focus:ring-primary-500 focus:border-primary-500" placeholder="Votre message"></textarea>
    </div>
    <button type="submit" class="py-3 px-5 text-sm font-medium text-center text-white rounded-lg bg-lime-800 sm:w-fit hover:bg-lime-950 focus:ring-4 focus:outline-none focus:ring-blue-300">Envoyer</button>
</form>

    </div>
</section>


















</body>
<?php
require('footer.php');
?>
