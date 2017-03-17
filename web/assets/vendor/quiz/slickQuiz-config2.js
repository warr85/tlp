// Setup your quiz text and questions here

// NOTE: pay attention to commas, IE struggles with those bad boys

var quizJSON = {
    "info": {
        "name":    "Segundo Quiz",
        "main":    "<p>Vamos a encender nuestros conocimientos a través del presente Quiz.  El mismo estará disponible una vez hayas aprendido la arquitectura de Git</p>",
        "results": "<h5>Saber más:</h5><p>Puedes expandir tu conocimiento a través del manual de git en español a través del siguiente enlace: <a href='#'>enlace</a>.</p>",
        "level1":  "Conocedor de GIT",
        "level2":  "Nociones de GIT",
        "level3":  "Iniciado en GIT",
        "level4":  "Novato en GIT",
        "level5":  "Es mejor volver a repasar las clases de GIT" // no comma here
    },
    "questions": [
        { // Question 1 - Multiple Choice, Single True Answer
            "q": "¿Qué es un Repositorio GIT?",
            "a": [
                {"option": "Una medicina para la fiebre",      "correct": false},
                {"option": "Un directorio con la estructura de git inicializada",     "correct": true},
                {"option": "el directorio de tu proyecto",      "correct": false},
                {"option": "un conjunto de archivos modificados",     "correct": false} // no comma here
            ],
            "correct": "<p><span>Correcto!</span> Un repositorio Git es un directorio que contiene la carpeta .git dentro de él.</p>",
            "incorrect": "<p><span>Uhh no.</span> Un repositorio Git es un directorio que contiene la carpeta .git dentro de él. </p>" // no comma here
        },
        { // Question 2 - Multiple Choice, Multiple True Answers, Select Any
            "q": "¿como se puede obtener un repositorio GIT?. debes seleccionar todas las que correspondan",
            "a": [
                {"option": "git --version",               "correct": false},
                {"option": "git init",   "correct": true},
                {"option": "git add .",               "correct": false},
                {"option": "git clone [URL]", "correct": true} // no comma here
            ],
            //"select_any": true,
            "correct": "<p><span>Excelente!</span> Puedes inicializarlo o puedes clonarlo</p>",
            "incorrect": "<p><span>Hmmm.... hay que repasar</span> debemos repasar la teoría sobre los repositorios de GIT.</p>" // no comma here
        },
        { // Question 3 - Multiple Choice, Multiple True Answers, Select All
            "q": "¿Cual comando añade un archivo al Stage Index?",
            "a": [
                {"option": "git add .",           "correct": false},
                {"option": "git commit -m 'archivo modificado'", "correct": false},
                {"option": "git init",  "correct": false},
                {"option": "git add nombre_archivo", "correct": true} // no comma here
            ],
            "correct": "<p><span>Brillante!</span> ya conoces como utilizar la estructura de tres árboles de git</p>",
            "incorrect": "<p><span>Incorrecto.</span> Debemos repasar como jugar con la estructura de tres árboles de git.</p>" // no comma here
        },
        { // Question 4
            "q": "¿La Arquitectura de tres árboles de git siempre están en sincronía?",
            "a": [
                {"option": "Si",    "correct": false},
                {"option": "No",     "correct": true} // no comma here
            ],
            //"select_any": true,
            "correct": "<p><span>WOW!</span> Felicidades! Son estructuras de archivos porque cada una puede ser diferente en cierto puento e iguales en otro.!</p>",
            "incorrect": "<p><span>Falla.</span> Lo siento. Son estructuras de archivos porque cada una puede ser diferente en cierto puento e iguales en otro.!</p>" // no comma here
        },
        { // Question 5
            "q": "Para confirmar los cambios del Stage Index al Repositorio ¿cual sería el comando?",
            "a": [
                {"option": "git commit -m 'mensaje de los cambios'",    "correct": true},
                {"option": "git commit .",     "correct": false},
                {"option": "git confirm -m 'mensaje de los cambios'",      "correct": false},
            ],
            "correct": "<p><span>Excelente!</span> Felicitaciones, con git commit -m 'menaje' confirmamos todo de manera permanente al repositorio</p>",
            "incorrect": "<p><span>Incorrecto.</span> Recuerda que con git commit -m 'menaje' confirmamos todo de manera permanente al repositorio.</p>" // no comma here
        },
        { // Question 6
            "q": "Existe una forma de enviar los cambios de manera directa del working directory al repositorio?",
            "a": [
                {"option": "Si",    "correct": true},
                {"option": "No",     "correct": false} // no comma here
            ],
            "correct": "<p><span>Muy Bien!</span> estas muy atento al video, más adelante explicaremos como!</p>",
            "incorrect": "<p><span>ERRRR!</span>debes estar más atento al vídeo.</p>" // no comma here
        }
    ]
};
