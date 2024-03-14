import logo from './logo.svg';
import './App.css';
import './estilos.css';
import gato1 from './img/gato.jpg';
import tordo from './img/tordo.jpg';
import login from './asset/login.jsxl';
import loginB64 from './asset/login.bin';





function App() {
  (async () => {
    try {
        // en el objeto “datos” tenemos los datos que vamos a enviar al servidor
        // en este ejemplo tenemos dos datos; un título y un array de números
        var datos = { titulo: "Listado de números", numeros: [2,4,6,8,10] };
        // en el objeto init tenemos los parámetros de la petición AJAX
        var init = {
            // el método de envío de la información será POST
            method: "POST",
            headers: { // cabeceras HTTP
                // vamos a enviar los datos en formato JSON
                'Content-Type': 'application/json'
            },
            // el cuerpo de la petición es una cadena de texto
            // con los datos en formato JSON
            body: JSON.stringify(datos), // convertimos el objeto a texto
            redirect: "error"
        };
        // realizamos la petición AJAX usando fetch
        // el primer parámetro es el recurso del servidor al que queremos acceder
        // en este ejemplo, es un fichero php llamado media.php que se encuentra
        // dentro de la carpeta ./php y con el código PHP que hay arriba.
        // el segundo parámetro es el objeto init con la información sobre los
        // datos que queremos enviar, el método de envio, etc.
        //
        var response = await fetch('http://atesco.loc/accion.php', init);
        if (response.ok) {
            // si la petición se ha resuelto correctamente,
            // intentamos resolver otra promesa que convierta
            // lo que nos ha respondido el servidor en un objeto de JavaScript.
            // si el servidor no ha enviado correctamente la información
            // en formato JSON, no se podrán convertir correctamente
            // los datos a un objeto, por lo que la promesa fallará
            // y esto provocará un error.
            //
            var respuesta = await response.json();
            /** en este ejemplo, el servidor nos devuelve un objeto con dos datos,
            // la media de los números enviados, y un fragmento de HTML
            // con un el título y una lista con los números
            **/
            alert("La media es: " + respuesta.media);
            document.write(respuesta.html);
            document.close();
        } else {
            throw new Error(response.statusText);
        }
    } catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }
})();
  return (
    <div className='contenedor'>
      <section className='vh-100 gradient-custom'>
        <div className='container py-5 h-100'>
          <div className='row d-flex justify-content-center align-items-center h-100'>
            <div className='card bg-dark text-white' style={{'border-radius':"1rem"}}>
              <div className='card-body p-5 text-center'>
                <div className='mb-md-5 mt-md-4 pb-5'>
                  {//<form action='http://atesco.loc/accion.php' method='post'>
                  }
                    <h2 className="fw-bold mb-2 text-uppercase">Login</h2>
                    <p className="text-white-50 mb-5">Please enter your login and password!</p>
                    <div className="form-outline form-white mb-4">
                      <input type="email" id="typeEmailX" name="email" className="form-control form-control-lg" />
                      <label className="form-label" for="typeEmailX">Email</label>
                    </div>
                    <div className="form-outline form-white mb-4">
                      <input type="password" id="typePasswordX" name="password" className="form-control form-control-lg" />
                      <label className="form-label" for="typePasswordX">Password</label>
                    </div>
                    <p className="small mb-5 pb-lg-2"><a className="text-white-50" href="#!">Forgot password?</a></p>
                    <button className="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
                    <div className="d-flex justify-content-center text-center mt-4 pt-1">
                      <a href="#!" className="text-white"><i className="fab fa-facebook-f fa-lg"></i></a>
                      <a href="#!" className="text-white"><i className="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                      <a href="#!" className="text-white"><i className="fab fa-google fa-lg"></i></a>
                    </div>
                  {//</form>
                  }
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
}
export default App;
