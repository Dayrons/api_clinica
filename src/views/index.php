<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/public/css/main.css">
    <title>Document</title>
</head>

<body>
    <header>
        <!-- <img src="src/public/img/doctor-crossing-arms-while-holding-stethoscope-in-white-coat.jpg" alt=""> -->
        <div class="container">
            <h1> API CLINICA</h1>

        </div>

    </header>

    <section>
        <div class="container">
            <h2>DOCTORES DISPONIBLES:</h2>
            <div>
            </div>
        </div>

        <div class="container ">
            <h2>CITAS:</h2>
            <div>
                <h4>CONSULTAR CITAS:</h4>
                <p>
                    Obtendras todas la citas registrada por los usuarios.
                </p>

                <div class="peticion">
                    <div class="peticion__metodo">
                        GET
                    </div>
                    <a class="peticion__url" href="http://localhost/api_clinica/cita">http://localhost/api_clinica/cita</a>
                </div>

            </div>

            <div>
                <h4>REGISTRAR CITA:</h4>
                <p>
                    Estructura del json para poder registrar una cita. Para poder registrar una cita primero debes registrarte como paciente y luego registrar la cita con tu DNI.
                </p>

                <pre>
                {
                    "dni": "27798260",
                    "sintomas" : "dolor estomacal",
                    "id_doctor": 1
                }
                </pre>

                <div class="peticion">
                    <div class="peticion__metodo">
                        POST
                    </div>
                    <a class="peticion__url" href="http://localhost/api_clinica/cita">http://localhost/api_clinica/cita</a>
                </div>

            </div>
            
            <div>
                <h4>CONSULTAR CITAS POR DNI:</h4>
                <p>
                    Obtendras todas las citas del paciente  el con  DNI especificado.
                </p>


                <div class="peticion">
                    <div class="peticion__metodo">
                        GET
                    </div>
                    <a class="peticion__url" href="http://localhost/api_clinica/cita">http://localhost/api_clinica/cita/{dni}</a>
                </div>

            </div>


        </div>

        <div class="container">
            <h2>PACIENTES:</h2>


            <div>
                <h4>LISTAR PACIENTE:</h4>
                <p>
                    Mostrara todos los pacientes registrados.
                </p>

            
                <div class="peticion">
                    <div class="peticion__metodo">
                        GET
                    </div>
                    <a class="peticion__url" href="http://localhost/api_clinica/pacientes">http://localhost/api_clinica/pacientes</a>
                </div>

            </div>

            <div>
                <h4>REGISTRAR PACIENTE:</h4>
                <p>
                    Estructura JSON para registrar un paciente
                </p>

                <pre>
                    {
                        "nombre": "nombre",
                        "apellido": "apellido",
                        "edad":21,
                        "genero": "M" /*M o F */,
                        "telefono":"04120148704",
                        "email": "email@example.com",
                        "dni": "dni"
                    }
                </pre>

                <div class="peticion">
                    <div class="peticion__metodo">
                        POST
                    </div>
                    <a class="peticion__url" href="http://localhost/api_clinica/pacientes">http://localhost/api_clinica/pacientes</a>
                </div>

            </div>

            <div>
                <h4>ELIMINAR PACIENTE:</h4>
                <p>
                    Elimina el paciente con el id especificado.
                </p>

                

                <div class="peticion">
                    <div class="peticion__metodo">
                        DELETE
                    </div>
                    <a class="peticion__url" href="http://localhost/api_clinica/pacientes/{id}">http://localhost/api_clinica/pacientes/{id}</a>
                </div>

            </div>      

        </div>

        <div class="container">
            <h2>DOCTORES:</h2>

            <div>
                <h4>LISTAR DOCTORES:</h4>
                <p>
                    Mostrara todos los doctores registrados.
                </p>

            
                <div class="peticion">
                    <div class="peticion__metodo">
                        GET
                    </div>
                    <a class="peticion__url" href="http://localhost/api_clinica/doctores">http://localhost/api_clinica/doctores</a>
                </div>

            </div>

            <div>
                <h4>REGISTRAR DOCTOR:</h4>
                <p>
                    Estructura JSON para registrar un paciente
                </p>

                <pre>
                    {
                        "nombre": "nombre",
                        "apellido": "apellido",
                        "especializacion": "dermatologia",
                        "edad":21,
                        "genero": "M" /*M o F */,
                        "telefono":"telefono",
                        "email": "email@example.com",
                        "dni": "dni"
                    }
                </pre>
            
                <div class="peticion">
                    <div class="peticion__metodo">
                        POST
                    </div>
                    <a class="peticion__url" href="http://localhost/api_clinica/doctores">http://localhost/api_clinica/doctores</a>
                </div>

            </div>

            <div>
                <h4>ELIMINAR DOCTOR:</h4>
                <p>
                    Eliminar doctor con el id especificado
                </p>

                
            
                <div class="peticion">
                    <div class="peticion__metodo">
                        DELETE
                    </div>
                    <a class="peticion__url" href="http://localhost/api_clinica/doctores/{id}">http://localhost/api_clinica/doctores/{id}</a>
                </div>

            </div>
            
            
        </div>

        


    </section>





</body>

</html>