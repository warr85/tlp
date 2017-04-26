// Setup your quiz text and questions here

// NOTE: pay attention to commas, IE struggles with those bad boys

var quizJSON = {
    "info": {
        "name":    "Quiz Final",
        "main":    "<p>Vamos a encender nuestros conocimientos a través de este 5to Quiz.  El mismo estará disponible una vez hayas aprendido la arquitectura de Git</p>",
        "results": "<h5>Saber más:</h5><p>Puedes expandir tu conocimiento a través del manual de git en español a través del siguiente enlace: <a href='#'>enlace</a>.</p>",
        "level1":  "Conocedor de GIT",
        "level2":  "Nociones de GIT",
        "level3":  "Iniciado en GIT",
        "level4":  "Novato en GIT",
        "level5":  "Es mejor volver a repasar las clases de GIT" // no comma here
    },
    "questions": [
        { // Question 1 - Multiple Choice, Single True Answer
            "q": "¿Que pasa cuando elminamos un archivo que git no sigue?",
            "a": [
                {"option": "no pasa nada",      "correct": true},
                {"option": "git detecta que un archivo ha sido eliminado",     "correct": false},
                {"option": "ninguna de las anteriores",      "correct": false}

            ],
            "correct": "<p><span>Correcto!</span> Correcto: Git no puede registrar algo que nunca ha tenido en su repositorio.</p>",
            "incorrect": "<p><span>Uhh no.</span> Git no puede tener registro de algo que nunca ha estado en su repositorio. </p>" // no comma here
        },
        { // Question 2 - Multiple Choice, Multiple True Answers, Select Any
            "q": "¿De cuantos árboles es la estructura de GIT?",
            "a": [
                {"option": "Dos",               "correct": false},
                {"option": "Cinco",   "correct": false},
                {"option": "Tres",   "correct": true}
            ],
            //"select_any": true,
            "correct": "<p><span>Excelente!</span> El Working Directory, el Stage Index y el repositorio</p>",
            "incorrect": "<p><span>Hmmm.... hay que repasar</span> recuerda que son El Working Directory, el Stage Index y el repositorio.</p>" // no comma here
        },
        { // Question 3 - Multiple Choice, Multiple True Answers, Select All
            "q": "Git es un controlador de versiones Centralizado",
            "a": [
                {"option": "Verdadero",           "correct": false},
                {"option": "Falso", "correct": true}


            ],
            "correct": "<p><span>Brillante!</span> porque git es un controlador de versiones DISTRIBUIDO</p>",
            "incorrect": "<p><span>Incorrecto.</span> Recuerda las primeras clases en los tipos de CVS: GIT es DISTRIBUIDO.</p>" // no comma here
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
        { // Question 4
            "q": "¿Que sucede si un archivo que está en el repositorio es modificado en el working?",
            "a": [
                {"option": "Nada",           "correct": false},
                {"option": "Sin Seguimiento",           "correct": false},
                {"option": "Modificado",     "correct": true} // no comma here
            ],
            //"select_any": true,
            "correct": "<p><span>WOW!</span> Felicidades! Ya manejas muy bien la teoría de Git</p>",
            "incorrect": "<p><span>Falla.</span> Lo siento. el Archivo se le asigna el estado de Modificado.!</p>" // no comma here
        },
        { // Question 4
            "q": "¿Que sucede si el repositorio está limpio y ejecutamos git diff?",
            "a": [
                {"option": "muestra los ultimos cambios realizados",           "correct": false},
                {"option": "Muestra lo ultimo añadido al stage", "correct": false},
                {"option": "ninguna de las anteriores'", "correct": true}

            ],
            //"select_any": true,
            "correct": "<p><span>WOW!</span> Felicidades! Para responder estas preguntas debes tener un gran conocimiento sobre la estructura y funcionamiento de GIT</p>",
            "incorrect": "<p><span>Falla.</span> Se que es un poco confuso, pero respansando lo vamos a lograr.!</p>" // no comma here
        },
        { // Question 4
            "q": "Si quiero que me aparezcan las confirmaciones desde una fecha hasta el presente, ¿Cuál sería el paremetro?",
            "a": [
                {"option": "--author",           "correct": false},
                {"option": "--since",           "correct": true},
                {"option": "--grep",           "correct": false},
                {"option": "--until",     "correct": false} // no comma here
            ],
            //"select_any": true,
            "correct": "<p><span>WOW!</span> Felicidades! Tienes el control y el super poder de controlar la historia del proyecto</p>",
            "incorrect": "<p><span>Falla.</span> te falta repasar el camino para adquirir este super poder.!</p>" // no comma here
        },
        { // Question 4
            "q": "¿Cómo revisamos el estado del repositorio local desde la última confirmación?",
            "a": [
                {"option": "git check",           "correct": false},
                {"option": "git commit",           "correct": false},
                {"option": "git diff",           "correct": false},
                {"option": "git status",     "correct": true} // no comma here
            ],
            //"select_any": true,
            "correct": "<p><span>WOW!</span> Felicidades! Lo usamos mucho en el curso y se usa mucho en acción real</p>",
            "incorrect": "<p><span>Falla.</span> Vamos ... lo usamos mucho en el curso... es git status.</p>" // no comma here
        },
        { // Question 4
            "q": "Quieres revisar todo el historial de confirmaciones, ¿Qué comando usas?",
            "a": [
                {"option": "git check",           "correct": false},
                {"option": "git history",           "correct": false},
                {"option": "git log",           "correct": true},
                {"option": "git bitac",     "correct": false} // no comma here
            ],
            //"select_any": true,
            "correct": "<p><span>WOW!</span> Felicidades! Tienes encendido los conocimientos con git</p>",
            "incorrect": "<p><span>Falla.</span> Vamos ... vamos ... tu puedes... es git log.</p>" // no comma here
        },
        { // Question 4
            "q": "¿Cómo preparamos archivos para luego poder confirmarlos?",
            "a": [
                {"option": "git check",           "correct": false},
                {"option": "git add",           "correct": true},
                {"option": "git commit",           "correct": false},
                {"option": "git status",     "correct": false} // no comma here
            ],
            //"select_any": true,
            "correct": "<p><span>WOW!</span> Felicidades! con git add enviamos archivos al stage donde son preparados para hacer un commit</p>",
            "incorrect": "<p><span>Falla.</span> Sabes que siempre puedes repasar las lecciones y volver a realizar los quiz.!</p>" // no comma here
        }

    ]
};
