// вешаем маску на поле
$('.license').mask('AAAAA-AAAAA-AAAAA-AAAAA', {
    translation: {A: {pattern: /[A-Z0-9]/}}, 
    placeholder: "_____-_____-_____-_____"
});