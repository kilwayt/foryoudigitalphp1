function setLanguagePreference(languageCode, languageName) {
    // Update the language text in the dropdown menu
    document.getElementById('selectedLanguage').innerText = languageName;

    // Set a cookie with the selected language
    document.cookie = `language=${languageCode}; path=/`;
    
    // Update the language text in the navigation bar
    const languageText = document.querySelector('.nav-language-text p');
    switch(languageCode) {
        case 'en':
            languageText.textContent = 'English';
            break;
        case 'ar':
            languageText.textContent = 'Arabic';
            break;
        case 'fr':
            languageText.textContent = 'French';
            break;
        // Add more cases for other languages as needed
    }
}
