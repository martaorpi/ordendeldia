<!DOCTYPE html>
    <html lang="en">
    
    @include('layouts.header-frontend')

    <body>
        <main id="main">
            <!-- ======= Formulario Section ======= -->
            <section id="form_registrar_huella" class="f-inscripcion section-bg">
                <div class="container" data-aos="fade-up">
                    <div class="blog-card card1">                        
                        <div class="inscripcion">	  
                            <form method="post" action="/registrar_huella" class="">
                                @csrf   
                                <h3 class="subtit-inscripcion">HUELLAS</h3>
                                <img src="assets/images/line-dark.png" class="img-line">

                                <div class="form-group row spacing m-fila">
                                    <div class="row mt-1 mb-1">
                                        <div class="col-4 tit-dedo">
                                            <label for="name">Pulgar</label>
                                            {{-- <input type="text" class="form-control" id="name" name="last_name" required> --}}
                                            <div class="img">
                                                <img class="imgFinger" src="{{('assets/images/finger.png')}}" />
                                            </div>
                                        </div>
                                        <div class="col-4 tit-dedo">
                                            <label for="name" class="lab">Indice</label>
                                            <input type="text" class="form-control" id="name" name="first_name" required>
                                        </div>
                                        <div class="col-4 tit-dedo">
                                            <label for="name" class="lab">Mayor</label>
                                            <input type="text" class="form-control" id="name" name="first_name" required>
                                        </div>
                                    </div>

                                    <div class="row mt-4 mb-4">
                                        <div class="col-2">
                                        </div>
                                        <div class="col-4 tit-dedo">
                                            <label for="name" class="lab">Anular</label>
                                            <input type="text" class="form-control" id="name" name="first_name" required>
                                        </div>                                
                                        <div class="col-4 tit-dedo">
                                            <label for="name" class="lab">Meñique</label>
                                            <input type="text" class="form-control" id="name" name="first_name" required>
                                        </div>
                                        <div class="col-2">
                                        </div>                                
                                    </div>
                                </div>
                            </form>                      
                        </div>
                    </div>
                </div>
            </section>
        </main>

        @include('layouts.footer-frontend')
    </body>
    
</html>