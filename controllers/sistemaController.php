<?php

/*
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class sistemaController extends Controller {

    private $_pdf;

    public function __construct() {
        parent::__construct();
        $this->_hotel = $this->loadModel('hotel');
        $this->_servicio = $this->loadModel('servicio');
        $this->_programa = $this->loadModel('programa');
        $this->_categoria = $this->loadModel('categoria');
        $this->_pais = $this->loadModel('pais');
        $this->_agencia = $this->loadModel('agencia');
        $this->_usuarios = $this->loadModel('usuario');
        $this->_booking = $this->loadModel('booking');
        $this->_carro = $this->loadModel('carro');
    }

    public function index() {
        Session::acceso('Usuario');

        $this->_view->objCiudadesHotel = $this->_hotel->getCiudadesHot();
        $this->_view->objCiudadesServ = $this->_servicio->getCiudadesServ();
        $this->_view->objCiudadesPRG = $this->_programa->getCiudadesPRG();

        $this->_view->setJs(array('ajax'));

        //if(Session::get('sess_pBP_ciudadDes'))
        //{
        $this->_view->mL_expandeFiltros = 'block';
        /* }
          else
          {
          $this->_view->mL_expandeFiltros='none';
          } */


        //$this->_view->assign('titulo', 'ORISTRAVEL'); SMARTY
        $this->_view->currentMenu = false;
        $this->_view->titulo = 'ORISTRAVEL';
        $this->_view->renderizaSistema('index');
    }

    public function pagina2() {
        Session::acceso('Especial');
        //$servicios= $this->loadModel('servicios');
        //$this->_view->servicios= $servicios->getServicios();

        $imagen = '';
        if (isset($_FILES['imagen']['name'])) {
            $this->getLibrary('upload' . DS . 'class.upload');
            $rutaImg = ROOT . 'public' . DS . 'img' . DS . 'hoteles' . DS;
            $upload = new upload($_FILES['imagen'], 'es_ES');
            $upload->allowed = array('image/jpg', 'image/png', 'image/gif');
            $upload->file_new_name_body = 'upl_' . uniqid();
            $upload->process($rutaImg);

            if ($upload->processed) {
                $imagen = $upload->file_dst_name; //nombre de la imagen
                $thumb = new upload($upload->file_dst_pathname);
                $thumb->image_resize = true;
                $thumb->image_x = 100;
                $thumb->image_y = 100;
                $thumb->file_name_body_pre = 'thumb_';
                $thumb->process($rutaImg . 'thumb' . DS);
            } else {
                $this->_view->errorImg = $upload->error;
            }
        }

        $this->_view->titulo = 'ORISTRAVEL';
        $this->_view->renderizaSistema('pagina2');
        //header('Location: ' . BASE_URL . 'confirmar');
    }
##########hotelControler#####################
    public function hoteles() {
        Session::acceso('Usuario');
        //$hotel= $this->loadModel('hotel');


        $this->_view->setJs(array('ajax'));

        $this->_view->objCategoriaHoteles = $this->_hotel->getCatHoteles();
        $this->_view->objCiudadesHotel = $this->_hotel->getCiudadesHot();
        $this->_view->objCiudadesServ = $this->_servicio->getCiudadesServ();
        $this->_view->objCiudadesPRG = $this->_programa->getCiudadesPRG();


        $this->_view->getHoteles = $this->_hotel->getAdmHoteles(
                Session::get('sess_pCH_ciudad'), Session::get('sess_pCH_nombre'), Session::get('sess_pCH_cat')
        );

        $this->_view->currentMenu = 2;
        $this->_view->titulo = 'ORISTRAVEL';
        $this->_view->renderizaSistema('hoteles');
    }

    public function editHotel() {
        Session::acceso('Usuario');
        $this->_view->setJs(array('ajax'));
        $EH_codHotel = $this->getTexto('post_codHotel');
        if ($EH_codHotel) {
            Session::set('sessMOD_EH_codHotel', $EH_codHotel);

            //$hoteles= $this->loadModel('hotel');
            //$categorias= $this->loadModel('categoria');

            $objHotel = $this->_hotel->getHotel($EH_codHotel);

            $this->_view->objCategorias = $this->_categoria->getCategorias();
            //$this->_view->objCategoriaHoteles= $this->_hotel->getCatHoteles();
            //$this->_views->objHoteles= $this->_hotel->getHotel($objHotel);


            if ($objHotel) {
                //echo 'ASDASD'; exit;
                $this->_view->EH_cod = $objHotel[0]->getCodigo();
                $this->_view->EH_hotel = $objHotel[0]->getHotel();
                $this->_view->EH_cat = $objHotel[0]->getCat();
                $this->_view->EH_lat = $objHotel[0]->getLat();
                $this->_view->EH_lon = $objHotel[0]->getLon();
                $this->_view->EH_direc = $objHotel[0]->getDirec();
                $this->_view->EH_web = $objHotel[0]->getSitioWeb();

                $this->_view->EH_imgEnc = $objHotel[0]->getImgEnc();
                $this->_view->EH_imgCont = $objHotel[0]->getImgCont();
                $this->_view->EH_imgCont2 = $objHotel[0]->getImgCont2();
                $this->_view->EH_imgCont3 = $objHotel[0]->getImgCont3();
                $this->_view->EH_imgCont4 = $objHotel[0]->getImgCont4();

                /* SERVICIOS HOTEL */
                if ($objHotel[0]->getRestaurante() == 1) {
                    $this->_view->EH_rest = 'checked="checked"';
                } else {
                    $this->_view->EH_rest = 'nochecked';
                }
                if ($objHotel[0]->getLavanderia() == 1) {
                    $this->_view->EH_lavan = 'checked="checked"';
                } else {
                    $this->_view->EH_lavan = 'nochecked';
                }
                if ($objHotel[0]->getBar() == 1) {
                    $this->_view->EH_bar = 'checked="checked"';
                } else {
                    $this->_view->EH_bar = 'nochecked';
                }
                if ($objHotel[0]->getCafeteria() == 1) {
                    $this->_view->EH_cafe = 'checked="checked"';
                } else {
                    $this->_view->EH_cafe = 'nochecked';
                }
                if ($objHotel[0]->getServHab() == 1) {
                    $this->_view->EH_servHab = 'checked="checked"';
                } else {
                    $this->_view->EH_servHab = 'nochecked';
                }
                if ($objHotel[0]->getBusiness() == 1) {
                    $this->_view->EH_business = 'checked="checked"';
                } else {
                    $this->_view->EH_business = 'nochecked';
                }
                if ($objHotel[0]->getInterHotel() == 1) {
                    $this->_view->EH_intHot = 'checked="checked"';
                } else {
                    $this->_view->EH_intHot = 'nochecked';
                }
                if ($objHotel[0]->getEstaciona() == 1) {
                    $this->_view->EH_est = 'checked="checked"';
                } else {
                    $this->_view->EH_est = 'nochecked';
                }
                if ($objHotel[0]->getPiscinaCub() == 1) {
                    $this->_view->EH_pCub = 'checked="checked"';
                } else {
                    $this->_view->EH_pCub = 'nochecked';
                }
                if ($objHotel[0]->getPiscinaDes() == 1) {
                    $this->_view->EH_pDes = 'checked="checked"';
                } else {
                    $this->_view->EH_pDes = 'nochecked';
                }
                if ($objHotel[0]->getGym() == 1) {
                    $this->_view->EH_gym = 'checked="checked"';
                } else {
                    $this->_view->EH_gym = 'nochecked';
                }
                if ($objHotel[0]->getSpa() == 1) {
                    $this->_view->EH_spa = 'checked="checked"';
                } else {
                    $this->_view->EH_spa = 'nochecked';
                }
                if ($objHotel[0]->getTenis() == 1) {
                    $this->_view->EH_tenis = 'checked="checked"';
                } else {
                    $this->_view->EH_tenis = 'nochecked';
                }
                if ($objHotel[0]->getGuarderia() == 1) {
                    $this->_view->EH_guard = 'checked="checked"';
                } else {
                    $this->_view->EH_guard = 'nochecked';
                }
                if ($objHotel[0]->getSalasReu() == 1) {
                    $this->_view->EH_salas = 'checked="checked"';
                } else {
                    $this->_view->EH_salas = 'nochecked';
                }
                if ($objHotel[0]->getJardin() == 1) {
                    $this->_view->EH_jardin = 'checked="checked"';
                } else {
                    $this->_view->EH_jardin = 'nochecked';
                }
                if ($objHotel[0]->getDiscapacitados() == 1) {
                    $this->_view->EH_disca = 'checked="checked"';
                } else {
                    $this->_view->EH_disca = 'nochecked';
                }
                if ($objHotel[0]->getBoutique() == 1) {
                    $this->_view->EH_bou = 'checked="checked"';
                } else {
                    $this->_view->EH_bou = 'nochecked';
                }


                /* SERVICIOS HABITACION */
                if ($objHotel[0]->getAcondicionado() == 1) {
                    $this->_view->EH_acon = 'checked="checked"';
                } else {
                    $this->_view->EH_acon = 'nochecked';
                }
                if ($objHotel[0]->getCalefaccion() == 1) {
                    $this->_view->EH_cale = 'checked="checked"';
                } else {
                    $this->_view->EH_cale = 'nochecked';
                }
                if ($objHotel[0]->getNoFuma() == 1) {
                    $this->_view->EH_noFuma = 'checked="checked"';
                } else {
                    $this->_view->EH_noFuma = 'nochecked';
                }
                if ($objHotel[0]->getCajaFuerte() == 1) {
                    $this->_view->EH_cajaF = 'checked="checked"';
                } else {
                    $this->_view->EH_cajaF = 'nochecked';
                }
                if ($objHotel[0]->getMiniBar() == 1) {
                    $this->_view->EH_mBar = 'checked="checked"';
                } else {
                    $this->_view->EH_mBar = 'nochecked';
                }
                if ($objHotel[0]->getTV() == 1) {
                    $this->_view->EH_tv = 'checked="checked"';
                } else {
                    $this->_view->EH_tv = 'nochecked';
                }
                if ($objHotel[0]->getTvCable() == 1) {
                    $this->_view->EH_tvC = 'checked="checked"';
                } else {
                    $this->_view->EH_tvC = 'nochecked';
                }
                if ($objHotel[0]->getInterHab() == 1) {
                    $this->_view->EH_intHab = 'checked="checked"';
                } else {
                    $this->_view->EH_intHab = 'nochecked';
                }
                if ($objHotel[0]->getSecador() == 1) {
                    $this->_view->EH_seca = 'checked="checked"';
                } else {
                    $this->_view->EH_seca = 'nochecked';
                }
                if ($objHotel[0]->getBarraSeg() == 1) {
                    $this->_view->EH_barra = 'checked="checked"';
                } else {
                    $this->_view->EH_barra = 'nochecked';
                }
                if ($objHotel[0]->getTelefono() == 1) {
                    $this->_view->EH_fono = 'checked="checked"';
                } else {
                    $this->_view->EH_fono = 'nochecked';
                }


                $this->_view->renderizaCenterBox('editHotel');
            } else {
                //echo 'asd'; exit;
                throw new Exception('Error al desplegar la edicion del hotel');
            }
        } else {
            //echo 'asd2'; exit;
            throw new Exception('Error al tratar de editar el hotel');
        }
    }

    public function modificarHotel() {
        if (strtolower($this->getServer('HTTP_X_REQUESTED_WITH')) == 'xmlhttprequest') {

            $MH_nombreHotel = $this->getTexto('txtEH_nombreHotel');
            $MH_direc = $this->getTexto('txtEH_direc');
            $MH_cate = $this->getTexto('cmbEH_categoria');
            $MH_lat = $this->getTexto('txtEH_latitud');
            $MH_lon = $this->getTexto('txtEH_longitud');
            $MH_sitWeb = $this->getTexto('txtEH_sitioWeb');



            if (!$MH_nombreHotel) {
                echo 'Debe ingresar un nombre de hotel';
                exit;
            } else if (!$MH_cate) {
                echo 'El hotel debe tener una categor&iacute;a';
                exit;
            } else if (!$MH_direc) {
                echo 'Debe ingresar una direcci&oacute;n para el hotel';
                exit;
            }

            if ($MH_nombreHotel) {

                // echo 'OK';
            }





            //$MH_Hotel= $this->_hotel;
            //$this->getLibrary('upload' . DS . 'class.upload');
            $rutaImg = ROOT . 'public' . DS . 'img' . DS . 'hoteles' . DS;


            for ($i = 1; $i <= 5; $i++) {
                if (isset($_FILES['flImagen' . $i]['name'])) {
                    if ($_FILES['flImagen' . $i]['name']) {
                        if (Funciones::validaFoto($_FILES['flImagen' . $i]['type']) == false) {
                            echo 'La Imagen ' . $i . ' debe ser formato [.JPG] [.GIF] [.PNG]';
                            exit;
                        }

                        if ($_FILES['flImagen' . $i]['size'] > 524288) { //512KB
                            echo 'La Imagen ' . $i . ' debe ser menor a <b>500kb</b>';
                            exit;
                        }
                    }
                }
            }





            //Servicios Hotel
            $MH_chkRest = Funciones::validaChk($this->getTexto('chkEH_rest'));
            $MH_chkLavan = Funciones::validaChk($this->getTexto('chkEH_lavan'));
            $MH_chkPisDesc = Funciones::validaChk($this->getTexto('chkEH_pisDesc'));
            $MH_chkCanTenis = Funciones::validaChk($this->getTexto('chkEH_cTenis'));
            $MH_chkBar = Funciones::validaChk($this->getTexto('chkEH_bar'));
            $MH_chkBusCen = Funciones::validaChk($this->getTexto('chkEH_busCen'));
            $MH_chkSpa = Funciones::validaChk($this->getTexto('chkEH_spa'));
            $MH_chkGuard = Funciones::validaChk($this->getTexto('chkEH_guarderia'));
            $MH_chkCafe = Funciones::validaChk($this->getTexto('chkEH_cafe'));
            $MH_chkInterHot = Funciones::validaChk($this->getTexto('chkEH_interHot'));
            $MH_chkGym = Funciones::validaChk($this->getTexto('chkEH_gym'));
            $MH_chkSaReu = Funciones::validaChk($this->getTexto('chkEH_sReu'));
            $MH_chkServHab = Funciones::validaChk($this->getTexto('chkEH_servHab'));
            $MH_chkEst = Funciones::validaChk($this->getTexto('chkEH_estaciona'));
            $MH_chkPisCub = Funciones::validaChk($this->getTexto('chkEH_pisCub'));
            $MH_chkJar = Funciones::validaChk($this->getTexto('chkEH_jardin'));
            $MH_chkDisca = Funciones::validaChk($this->getTexto('chkEH_disca'));
            $MH_chkBou = Funciones::validaChk($this->getTexto('chkEH_bou'));


            //Servicios Habitacion
            $MH_chkAirAcond = Funciones::validaChk($this->getTexto('chkEH_airAcond'));
            $MH_chkCaFuerte = Funciones::validaChk($this->getTexto('chkEH_cFuerte'));
            $MH_chkTvCable = Funciones::validaChk($this->getTexto('chkEH_tvCable'));
            $MH_chkSecPelo = Funciones::validaChk($this->getTexto('chkEH_sPelo'));
            $MH_chkCalef = Funciones::validaChk($this->getTexto('chkEH_calefac'));
            $MH_chkMinBar = Funciones::validaChk($this->getTexto('chkEH_mBar'));
            $MH_chkFono = Funciones::validaChk($this->getTexto('chkEH_fono'));
            $MH_chkBarraSeg = Funciones::validaChk($this->getTexto('chkEH_barraSeg'));
            $MH_chkNoFumar = Funciones::validaChk($this->getTexto('chkEH_noFumar'));
            $MH_chkTV = Funciones::validaChk($this->getTexto('chkEH_tv'));
            $MH_chkInterHab = Funciones::validaChk($this->getTexto('chkEH_interHab'));


            $MH_sql = 'UPDATE hotel 
                    SET hotel="' . mb_convert_encoding($MH_nombreHotel, "ISO-8859-1", "UTF-8") . '", direc="' . mb_convert_encoding($MH_direc, "ISO-8859-1", "UTF-8") . '", cat="' . $MH_cate . '", SWEB="' . $MH_sitWeb . '", estado="", 
                    lat="' . $MH_lat . '", lon="' . $MH_lon . '", restaurante=' . $MH_chkRest . ', bar=' . $MH_chkBar . ', cafeteria=' . $MH_chkCafe . ', 
                    s_habitacion=' . $MH_chkServHab . ', busness_center=' . $MH_chkBusCen . ', internet_hotel=' . $MH_chkInterHot . ', estacionamiento=' . $MH_chkEst . ', 
                    piscina_cub=' . $MH_chkPisCub . ', piscina_des=' . $MH_chkPisDesc . ', gym=' . $MH_chkGym . ', spa=' . $MH_chkSpa . ', tenis=' . $MH_chkCanTenis . ', 
                    guarderia=' . $MH_chkGuard . ', salas_reunion=' . $MH_chkSaReu . ', jardin=' . $MH_chkJar . ', discapacitados=' . $MH_chkDisca . ', 
                    bautique=' . $MH_chkBou . ', acondicionado=' . $MH_chkAirAcond . ', calefaccion=' . $MH_chkCalef . ', no_fuma=' . $MH_chkNoFumar . ', 
                    caja_fuerte=' . $MH_chkCaFuerte . ', mini_bar=' . $MH_chkMinBar . ', television=' . $MH_chkTV . ', tv_cable=' . $MH_chkTvCable . ', 
                    inter_hab=' . $MH_chkInterHab . ', secador_pelo=' . $MH_chkSecPelo . ', barra_seguridad=' . $MH_chkBarraSeg . ', 
                    lavanderia=' . $MH_chkLavan . ', fono=' . $MH_chkFono;




            for ($i = 1; $i <= 5; $i++) {
                if (isset($_FILES['flImagen' . $i]['name'])) {
                    if ($_FILES['flImagen' . $i]['name']) {
                        $this->getLibrary('upload' . DS . 'class.upload');
                        $upload = new upload($_FILES['flImagen' . $i], 'es_ES');
                        $upload->allowed = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');
                        $upload->file_max_size = '524288'; // 512KB
                        $upload->file_new_name_body = 'upl_' . sha1(uniqid());
                        $upload->process($rutaImg);

                        if ($upload->processed) {   //THUMBNAILS
                            $imagen = $upload->file_dst_name; //nombre de la imagen
                            //$MH_sql.= ', foto' . $i . '= "' . $imagen . '" ';

                            $thumb = new upload($upload->file_dst_pathname);
                            $thumb->image_resize = true;
                            $thumb->image_x = 150;
                            $thumb->image_y = 150;
                            $thumb->file_name_body_pre = 'thumb_';
                            $thumb->process($rutaImg . 'thumb' . DS);

                            if ($i == 1) {
                                $MH_sql.=', img_encabezado = "' . $imagen . '", mini_img_encabezado = "' . $imagen . '" ';
                            } else if ($i == 2) {
                                $MH_sql.=', img_contenido = "' . $imagen . '", mini_img_contenido = "' . $imagen . '" ';
                            } else {
                                $MH_sql.=', img_contenido' . ($i - 1) . ' = "' . $imagen . '", mini_img_contenido' . ($i - 1) . ' = "' . $imagen . '" ';
                            }
                        } else {
                            echo '(Imagen ' . $i . ')' . $upload->error . '<br>';
                        }
                    }
                } else {
                    if ($i == 1) {
                        if ($this->getTexto('chkEH_flImagen' . $i) == 'on') {
                            Funciones::eliminaFile($rutaImg . Session::get('sessMOD_DTH_img' . $i));
                            Funciones::eliminaFile($rutaImg . 'thumb' . DS .'thumb_'. Session::get('sessMOD_DTH_img' . $i));
                            $MH_sql.=', img_encabezado = "", mini_img_encabezado = "" ';
                        }
                    } else if ($i == 2) {
                        if ($this->getTexto('chkEH_flImagen' . $i) == 'on') {
                            Funciones::eliminaFile($rutaImg . Session::get('sessMOD_DTH_img' . $i));
                            Funciones::eliminaFile($rutaImg . 'thumb' . DS .'thumb_'. Session::get('sessMOD_DTH_img' . $i));
                            $MH_sql.=', img_contenido = "", mini_img_contenido = "" ';
                        }
                    } else {
                        if ($this->getTexto('chkEH_flImagen' . $i) == 'on') {
                            Funciones::eliminaFile($rutaImg . Session::get('sessMOD_DTH_img' . $i));
                            Funciones::eliminaFile($rutaImg . 'thumb' . DS .'thumb_'. Session::get('sessMOD_DTH_img' . $i));
                            $MH_sql.=', img_contenido' . ($i - 1) . ' = "", mini_img_contenido' . ($i - 1) . ' = "" ';
                        }
                    }
                }
            }


            $MH_sql.=' WHERE codigo=' . $_SESSION['sessMOD_EH_codHotel'];

            //echo $MH_sql; exit;
            $this->_hotel->exeSQL($MH_sql);

            echo 'OK';
        } else {
            throw new Exception('Error inesperado, intente nuevamente. Si el error persiste comuniquese con el administrador.');
        }
    }

     public function buscarHoteles() {
        Session::acceso('Usuario');


        /* BEIGN: Paginador; */
        $pagina = 0;
        $pagina = $this->filtrarInt($pagina);
        $this->getLibrary('paginador');
        $paginador = new Paginador();
        /* $this->_view->getHoteles=$paginador->paginar($hoteles->getHoteles(), $pagina); */
        //$this->_view->paginacion = $paginador->getView('prueba', 'sistema/buscarHoteles');
        /* END: Paginador; */


        $this->_view->currentMenu = 8;
        $this->_view->titulo = 'ORISTRAVEL';
        $this->_view->renderizaSistema('buscarHoteles');
    }
    
#######################fin hotelControler###########################
    
###################### programaControler############################   
    public function adminProgramas() {
        Session::acceso('Usuario');
        $this->_view->setJs(array('ajax'));

        $this->_view->objCiudadesHotel = $this->_hotel->getCiudadesHot();
        $this->_view->objCiudadesServ = $this->_servicio->getCiudadesServ();
        $this->_view->objCiudadesPRG = $this->_programa->getCiudadesPRG(); //Session::get('sess_combo_pais')

        $this->_view->objPais = $this->_pais->getPaises();

        $this->_view->objProgramas = $this->_programa->getAdmProgramas();

        $this->_view->currentMenu = 3;
        $this->_view->titulo = 'ORISTRAVEL';
        $this->_view->renderizaSistema('adminProgramas');
    }

    public function subirPdf() {//Pagina
        Session::acceso('Usuario');

        $this->_view->SP_codProg = $this->getTexto('post_codProg');
        $this->_view->setJs(array('ajax'));

        $this->_view->renderizaCenterBox('subirPdf');
    }

    public function verPDF() {
        Session::acceso('Usuario');

        $texto = $this->getTexto('post_codProg');
        $texto_cambiado = str_replace(" ", "_", $texto);
        $this->_view->VP_codPDF = $texto_cambiado;

        $this->_view->setJs(array('ajax'));
        $this->_view->renderizaCenterBox('verPdf');
    }

    public function subirCarPdf() {
        $SP_codigo = $this->getTexto('txtFile');

        //$SP_codigo = $this->SP_codProg;
        if (isset($_FILES['SpFile']['name'])) {

            if ($_FILES['SpFile']['name']) {
                if (Funciones::validaArchivo($_FILES['SpFile']['type']) == false) {
                    echo 'El Archivo debe ser formato [.PDF]';
                    exit;
                }

                if ($_FILES['SpFile']['size'] > 1048576) { //1Mb
                    echo 'El archivo debe ser menor a <b>1Mb</b>';
                    exit;
                }
            }
            $this->getLibrary('upload' . DS . 'class.upload');
            $rutaPdf = ROOT . 'public' . DS . 'pdf' . DS;
            $upload = new upload($_FILES['SpFile'], 'es_ES');
            $upload->allowed = ('application/pdf');
            $upload->file_max_size = '1048576'; //1Mb
            $upload->file_new_name_body = 'upl_' . $SP_codigo;

            $upload->file_overwrite = true;
            $upload->process($rutaPdf);

            if ($upload->processed) {
                echo 'OK';
            } else {
                //echo 'Error al subir el archivo';
                throw new Exception('Error al subir el archivo');
            }
        } else {
            throw new Exception('Error inesperado, intente nuevamente. Si el error persiste comuniquese con el administrador.');
        }
        //$this->redireccionar('sistema/adminProgramas');
    }

    public function eliminarPdf() {
        $archivo = $this->getTexto('txtNombreFile');
        $ruta = ROOT . 'public' . DS . 'pdf' . DS . $archivo;
        if (unlink($ruta)) {
            echo 'OK';
        } else {


            echo 'No se puede eliminar PDF';
        }
        //$this->redireccionar('sistema/adminProgramas');
    }
#####################imagenesController#######################
    public function imagenes() {
        Session::acceso('Usuario');

        $this->_view->objCiudadesHotel = $this->_hotel->getCiudadesHot();
        $this->_view->objCiudadesServ = $this->_servicio->getCiudadesServ();
        $this->_view->objCiudadesPRG = $this->_programa->getCiudadesPRG();
        $this->_view->objAgenciaImagenes= $this->_agencia->getAgencias(0);

        $this->_view->currentMenu = 5;
        $this->_view->titulo = 'ORISTRAVEL';
        $this->_view->renderizaSistema('imagenes');
    }
########################carroController########################
    public function carro() {
        Session::acceso('Usuario');
        
        $this->_view->currentMenu = false;
        $this->_view->titulo = 'ORISTRAVEL';
        
        $this->_view->objCarro = $this->_carro->getAddCarro(Session::get('sess_usuario'));
        
        $this->_view->renderizaSistema('carro');       
    }              
########################contactoController###################################
    public function contactenos() {
        Session::acceso('Usuario');
        $this->_view->currentMenu = 7;
        $this->_view->titulo = 'ORISTRAVEL';
        $this->_view->renderizaSistema('contactenos');
    }

    public function enviarContacto() {
        Session::set('sess_ultima_hora', date('H:i:s'));
        if (Session::get('sess_ipcfg')) {
            if (Session::get('sess_ultima_hora')) {
                Session::destroy('sessError');
                $hd_Cliente = Session::get('sess_agencia');
                $usuario = Session::get('sess_nombre') . ' ' . Session::get('sess_apellido');
                $mensaje = $this->getTexto('area');
                $html = file_get_contents(ROOT . 'views' . DS . 'sistema' . DS . 'mails' . DS . 'correoContacto.html');
                $reempl = array('logo' => ENT_LOGO,
                    'subdominio' => ENT_SUB_DOMAIN,
                    'comentario' => $mensaje,
                    'hdCliente' => $hd_Cliente,
                    'nombre_completo' => $usuario,
                    'fecha' => date('d/m/Y'),
                    'hora' => date('H:i:s'));

                foreach ($reempl as $nombre => $valor) {
                    $html = str_replace('{' . $nombre . '}', $valor, $html);
                }

                if (!empty($mensaje)) {
                    //--------------------------Configuracion Correo---------------------  
                    $this->getLibrary('class.phpmailer');
                    $mail = new PHPMailer();
                    $mail->IsSMTP();
                    $mail->SMTPAuth = true;

                    //$mail->Port = 25;
                    $mail->Host = "mail.oristravel.com";
                    $mail->Username = "oris@oristravel.com";
                    $mail->Password = "tsyacom01";

                    $mail->From = 'oris@oristravel.com';
                    $mail->FromName = 'Solicitud de Contacto WEB-ORIS';
                    $mail->CharSet = CHARSET;
                    $mail->Subject = 'Confirmacion de reserva online: ';
                    $mail->Body = $mensaje;

                    $mail->MsgHTML($html);

                    $mail->AddAddress('jjreyes.romero88@gmail.com', "Jaime Reyes");
                    if (date('H:i:s') <= date('H:i:s', strtotime('+60 second', strtotime(Session::get('sess_ultima_hora'))))) {

                        if (Session::get('sess_intentos') >= 5) {

                            echo 'Debe cerrar sesion';
                        } else {
                            if ($mail->Send()) {
                                Session::set('sess_intentos', (Session::get('sess_intentos') + 1));
                                echo 'OK';
                            } else {

                                echo 'Error al enviar el Correo';
                            }
                        }
                    }
                } else {
                    echo 'Escriba un mensaje';
                }
            }
        }
    }
###############################usuarioController################################
    public function usuarios() {
        Session::acceso('Usuario');

        $this->_view->objAgencia = $this->_agencia->getAgencias(0);
        $this->_view->setJs(array('ajax'));

        $this->_view->objEditUs = $this->_usuarios->getUsuariosEdit(0);




        $this->_view->currentMenu = 4;
        $this->_view->titulo = 'ORISTRAVEL';
        $this->_view->renderizaSistema('usuarios');
    }

    public function insertUsuarios() {
        if (strtolower($this->getServer('HTTP_X_REQUESTED_WITH')) == 'xmlhttprequest') {

            $US_idAgencia = $this->getTexto('US_cmbAgencia');
            $US_clave = crypt($this->getTexto('US_txtClave'), 't5y4c0m');
            $US_login = $this->getTexto('US_txtLogin');
            $US_nombre = $this->getTexto('US_txtNombre');
            $US_apellido = $this->getTexto('US_txtApe');
            $US_correo = Funciones::validarEmail($this->getTexto('US_txtCorreo'));
            $US_correoAdm = Funciones::validarEmail($this->getTexto('US_txtCorreoAdm'));
            $US_correoEj = Funciones::validarEmail($this->getTexto('US_txtCorreoEj'));
            $US_Estado = $this->getTexto('US_cmbEstado');
            $US_tipoUs = $this->getTexto('US_cmbTipoUs');

            if ($US_login & $US_idAgencia & $US_clave & $US_nombre & $US_apellido & $US_tipoUs) {
                if ($US_correo & $US_correoAdm & $US_correoEj) {

                    $US_sql = "INSERT INTO usuarios(id_agenc_na, clave, login, nombre, apellido, correo , correo_admin, correo_ejecutivo, estado, tipo_usuario)
                        VALUES(" . $US_idAgencia . ",'" . $US_clave . "','" . $US_login . "','" . $US_nombre . "','" . $US_apellido . "','" . $US_correo . "','" . $US_correoAdm . "','" . $US_correoEj . "','" . $US_Estado . "','" . $US_tipoUs . "')";

                    $this->_usuarios->exeSQL($US_sql);

                    echo 'OK';
                } else {
                    echo "Ingrese correos válidos, por ejemplo: juan@empresa.com";
                }
            } else {
                echo "No se admiten campos vacíos";
            }
        } else {
            throw new Exception('Error inesperado, intente nuevamente. Si el error persiste comuniquese con el administrador.');
        }
    }

    public function editUsuarios() {
        Session::acceso('Usuario');
        //$this->_view->setJs(array('ajax'));
        $EU_idus = $this->getTexto('post_codUs');
        Session::set('sess_EU_codUs', $EU_idus);
        //$this->_view->objEditUsCenter = $this->_usuarios->getUsuarios($EU_idus);  

        $objEditUsuario = $this->_usuarios->getUsuariosEdit($EU_idus);
        $this->_view->objAgencias = $this->_agencia->getAgencias(0);
        if ($EU_idus) {

            if ($objEditUsuario) {
                $this->_view->EU_Id = $objEditUsuario[0]->getIdUsuario();
                $this->_view->EU_idAgen = $objEditUsuario[0]->getIdAgencNa();
                $this->_view->EU_clave = $objEditUsuario[0]->getClave();
                $this->_view->EU_login = $objEditUsuario[0]->getLogin();
                $this->_view->EU_nombre = $objEditUsuario[0]->getNombre();
                $this->_view->EU_apellido = $objEditUsuario[0]->getApellido();
                $this->_view->EU_correo = $objEditUsuario[0]->getCorreo();
                $this->_view->EU_correoAdm = $objEditUsuario[0]->getCorreoAdmin();
                $this->_view->EU_correoEjec = $objEditUsuario[0]->getCorreoEjecutivo();
                $this->_view->EU_tipoUs = $objEditUsuario[0]->getTipoUsuario();
                $this->_view->EU_estado = $objEditUsuario[0]->getEstado();
                $this->_view->EU_Agen = $objEditUsuario[0]->getAgencia();
                
            } else {

                throw new Exception('Error al desplegar la edicion del usuario');
            }
        } else {
            throw new Exception('Error al tratar de editar el usuario');
        }


        $this->_view->renderizaCenterBox('editUsuario');
    }

    public function modificarUsuario() {
        if (strtolower($this->getServer('HTTP_X_REQUESTED_WITH')) == 'xmlhttprequest') {

            $EU_idAgencia = $this->getTexto('EU_cmbAgencia');
            $EU_clave = $this->getTexto('EU_txtClave');
            //$EU_login = $this->getTexto('EU_txtLogin');
            $EU_nombre = $this->getTexto('EU_txtNombre');
            $EU_apellido = $this->getTexto('EU_txtApe');
            $EU_correo = Funciones::validarEmail($this->getTexto('EU_txtCorreo'));
            $EU_correoAdm = Funciones::validarEmail($this->getTexto('EU_txtCorreoAdm'));
            $EU_correoEj = Funciones::validarEmail($this->getTexto('EU_txtCorreoEj'));
            $EU_Estado = $this->getInt('EU_cmbEstado');
            $EU_tipoUs = $this->getTexto('EU_cmbTipoUs');
            
            if ($EU_idAgencia & $EU_clave & $EU_nombre & $EU_apellido & $EU_tipoUs) {
                
                if ($EU_correoAdm & $EU_correo & $EU_correoEj) {
                    $EU_sql = 'UPDATE usuarios '
                            . 'SET id_agenc_na=' . $EU_idAgencia . ','
                            . 'nombre = "' . $EU_nombre . '",'
                            . 'apellido="' . $EU_apellido . '", correo="' . $EU_correo . '",'
                            . 'correo_admin ="' . $EU_correoAdm . '", correo_ejecutivo="' . $EU_correoEj . '",'
                            . 'estado = ' . $EU_Estado . ', tipo_usuario = ' . $EU_tipoUs . ' ';

                    if ($EU_clave != '************') {
                        $EU_sql .= ' clave="' . crypt($EU_clave, 't5y4c0m') . '"';
                    }

                    $EU_sql.=' WHERE id = ' . Session::get('sess_EU_codUs') . '';


                    $this->_usuarios->exeSQL($EU_sql);
                    //echo $EU_sql; 

                    echo 'OK';
                } else {
                    echo "Ingrese correos válidos, por ejemplo: juan@empresa.com";
                }
            } else {
                echo "No se admiten campos vacíos";
            }
        } else {
            throw new Exception('Error inesperado, intente nuevamente. Si el error persiste comuniquese con el administrador.');
        }
    }

    public function borrarUsuariosPopUp(){

      $this->_view->renderizaCenterBox('borrarUsuario');
    
    }
    
    public function borrarUsuarios(){
     if (strtolower($this->getServer('HTTP_X_REQUESTED_WITH')) == 'xmlhttprequest') {
     $BU_sql = 'DELETE FROM usuarios WHERE id='.Session::get('sess_EU_codUs').'';

        if($this->_usuarios->exeSQL($BU_sql)){
         echo 'OK';    
        }
        else{
         echo 'No se pudo eliminar el Usuario';
        }
     }

    else{
                throw new Exception('Error inesperado, intente nuevamente. Si el error persiste comuniquese con el administrador.');
     } 
        
    }

   
################################ fin usuarioController###########################  
 
    
    ################################### imagenesController#####################################
public function logoVoucher(){
Session::acceso('Usuario');

$id_Agen = $this->getTexto('post_f_valor');
Session::set('sess_id_agen', $id_Agen);
$objEditUsuario = $this->_agencia->getAgencias($id_Agen);
    if($id_Agen){
        if($objEditUsuario){
            $this->_view->I_imagen = $objEditUsuario[0]->getImagen();
            $this->_view->I_nombre = $objEditUsuario[0]->getNombre();
            $this->_view->I_Id = $objEditUsuario[0]->getId();
        }
        else{
            throw new Exception('Error al desplegar la edicion del usuario');
        }
    }
    else
    {
    throw new Exception('Error al tratar de desplegar las imagenes');
    }
$this->_view->renderizaCenterBox('logoVoucher');
}

    public function modificarLogoVoucher()
    {
        if(strtolower($this->getServer('HTTP_X_REQUESTED_WITH'))=='xmlhttprequest')
        {
            $rutaIMG= ROOT . 'public' . DS . 'img' . DS . 'voucher' . DS;
            $MLV_agencia= $this->_agencia->getAgencias(Session::get('sess_id_agen'));
           
            
            if(isset($_FILES['flImagenVouAgen']['name']))
            {
                if($_FILES['flImagenVouAgen']['name'])
                {
                    $this->getLibrary('upload' . DS . 'class.upload');

                    $upload= new upload($_FILES['flImagenVouAgen'], 'es_ES');
                    $upload->allowed= array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');
                    $upload->file_max_size = '524288'; // 512KB
                    //$upload->file_new_name_body= 'upl_' . uniqid();
                    $upload->file_new_name_body= 'upl_' . Session::get('sess_id_agen');
                    $upload->process($rutaIMG);

                    if($upload->processed)
                    {
                        //echo $upload->file_dst_name_body.'.'.$upload->file_dst_name_ext;
                       $this->_agencia->actualizaVoucherAgen(Session::get('sess_id_agen'), $upload->file_dst_name_body.'.'.$upload->file_dst_name_ext);
                        echo 'OK';
                        
                    }
                    else
                    {
                        throw new Exception( $upload->error );
                    }
                }
                else
                {
                    throw new Exception('Debe seleccionar una foto');
                }
            }
            else
            {
                
                if($this->getTexto('chk_flImagenVouAgen'))
                {
                    if($this->getTexto('chk_flImagenVouAgen')=='on')
                    {
                        if(Funciones::eliminaFile($rutaIMG . $this->getTexto('txtImg')))
                        {
                            $this->_agencia->actualizaVoucherAgen(Session::get('sess_id_agen'), '');
                            
                            echo 'OK';
                        }
                        else
                        {
                            throw new Exception('Error al eliminar el archivo, intente nuevamente');
                        }
                    }
                    else
                    {
                        throw new Exception('Debe seleccionar un archivo a eliminar');
                    }
                }
                else
                {
                    throw new Exception('Debe seleccionar un archivo desde su computador');
                }
            }
        }
        else
        {
            throw new Exception('Error inesperado, intente nuevamente. Si el error persiste comuniquese con el administrador');
        }
    }
  #####################fin imagenesController################################
    
  ############################ bookingController #############################  
    public function consultarBooking($pagina = false) {
        Session::acceso('Usuario');

        $this->_view->objCiudadesHotel = $this->_hotel->getCiudadesHot();
        $this->_view->objCiudadesServ = $this->_servicio->getCiudadesServ();
        $this->_view->objCiudadesPRG = $this->_programa->getCiudadesPRG();


        $this->_view->CR_fechaDesde = date('d/m/Y');
        if (Session::get('sess_pCR_fechaDesde')) {
            $this->_view->CR_fechaDesde = Session::get('sess_pCR_fechaDesde');
        }


        $this->_view->rdbRes = false;
        $this->_view->rdbVia = false;
        $this->_view->CR_fechaHasta = Funciones::sumFecha(date('d/m/Y'), 0, 3);
        if (Session::get('sess_pCR_tipoFecha') == 1) {
            $this->_view->rdbRes = 'checked';
        } else {
            $this->_view->rdbVia = 'checked';
        }
        $this->_view->getBookings = $this->_booking->getConsRes(
                Funciones::invertirFecha(Session::get('sess_pCR_fechaDesde'), '/', '-'), Funciones::invertirFecha(Session::get('sess_pCR_fechaHasta'), '/', '-'), Session::get('sess_pCR_tipoFecha'), Session::get('sess_id_agencia'), Session::getLevel('Admin'), Session::get('sess_usuario')
        );



        /* BEIGN: Paginador; */
        $pagina = $this->filtrarInt($pagina);
        $this->getLibrary('paginador');
        $paginador = new Paginador();
        /* $this->_view->getBookings=$paginador->paginar($booking->getConsRes(
          Funciones::invertirFecha(Session::get('sess_pCR_fechaDesde'), '/', '-'),
          Funciones::invertirFecha(Session::get('sess_pCR_fechaHasta'), '/', '-'),
          Session::get('sess_pCR_tipoFecha'),
          Session::get('sess_id_agencia'),
          Session::getLevel('Admin'),
          Session::get('sess_usuario')
          ), $pagina); */
        $this->_view->paginacion = $paginador->getView('prueba', 'sistema/consultarBooking');
        /* END: Paginador; */



        $this->_view->currentMenu = 1;
        $this->_view->titulo = 'ORISTRAVEL';
        $this->_view->renderizaSistema('consultarBooking');
    }
    
    public function reservaBooking(){
    Session::acceso('Usuario');
    
    $objBooking = $this->_booking->getBooking($this->getTexto('n_file'));
    if($objBooking){
    $this->_view->BK_Id = $objBooking[0]->getId();
    $this->_view->BK_Agencia = $objBooking[0]->getAgencia();
    $this->_view->BK_NomPax = $objBooking[0]->getNomPax();
    $this->_view->BK_Fecha_Anul = $objBooking[0]->getFecha_Anul();
    $this->_view->BK_NombreUser = $objBooking[0]->getNombreUser();
    $this->_view->BK_ApellidoUser = $objBooking[0]->getApellidoUser();
    $this->_view->BK_FechaIn = $objBooking[0]->getFechaIn();
    $this->_view->BK_Total = $objBooking[0]->getTotal();
    $this->_view->BK_Registro = $objBooking[0]->getRegistro();
    $this->_view->BK_moneda  = $objBooking[0]->getMoneda();
    }
    else {
                throw new Exception('Error al desplegar la Reserva');
         }
    $this->_view->ObjDbk = $this->_booking->getDbooking($this->getTexto('n_file'));
    $this->_view->ObjPbk = $this->_booking->getPbooking($this->getTexto('n_file'));
    
    $objHabPbk = $this->_booking->getPbooking($this->getTexto('n_file'));
    if($objHabPbk){
    $this->_view->PBK_nhab = $objHabPbk[0]->getNhab();   
        
    }
    else {
                throw new Exception('Error al desplegar la Reserva');
         }
    
    $this->_view->renderizaCenterBox('reservaBooking');   

    
    }

    public function crearExcel(){
    header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");  
    header ("Cache-Control: no-cache, must-revalidate");  
    header ("Pragma: no-cache");  
    header ("Content-type: application/vnd.ms-excel");
    header ("Content-Disposition: attachment; filename=\"NengocioOris.csv\"" );
    
    $objBooking = $this->_booking->getConsRes(
                Funciones::invertirFecha(Session::get('sess_pCR_fechaDesde'), '/', '-'), Funciones::invertirFecha(Session::get('sess_pCR_fechaHasta'), '/', '-'), Session::get('sess_pCR_tipoFecha'), Session::get('sess_id_agencia'), Session::getLevel('Admin'), Session::get('sess_usuario')
        );
      echo "Negocio; Estado; Fecha; Fecha In; Nombre Cliente; Vendedor; Nombre Pasajero; Moneda; Total; \n";      
        foreach($objBooking as $objb){
          
                echo  $objb->getId().";"
                    . $objb->getEstado().";"
                    . $objb->getFecha().";"
                    . $objb->getFechaIn().";"
                    . $objb->getAgencia().";"
                    . $objb->getNombreUser().$objb->getApellidoUser().";"
                    . $objb->getNomPax().";"
                    . $objb->getMoneda().";"
                    . round($objb->getTotal()).";"; 
                echo "\n";
        }             
        
    }
    
    public function crearExcelDet(){
    header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");  
    header ("Cache-Control: no-cache, must-revalidate");  
    header ("Pragma: no-cache");  
    header ("Content-type: application/vnd.ms-excel");
    header ("Content-Disposition: attachment; filename=\"NegocioOrisDetalle.csv\"" );
    
    $objBooking = $this->_booking->getConsRes(
                Funciones::invertirFecha(Session::get('sess_pCR_fechaDesde'), '/', '-'), Funciones::invertirFecha(Session::get('sess_pCR_fechaHasta'), '/', '-'), Session::get('sess_pCR_tipoFecha'), Session::get('sess_id_agencia'), Session::getLevel('Admin'), Session::get('sess_usuario')
        );

      //echo "Negocio; Estado; Fecha; Fecha In; Nombre Cliente; Vendedor; Nombre Pasajero; Moneda; Total; \n\n"; 
        foreach($objBooking as $objb){
          echo "Negocio; Estado; Fecha; Fecha In; Nombre Cliente; Vendedor; Nombre Pasajero; Moneda; Total; \n";   
                echo  $objb->getId().";"
                    . $objb->getEstado().";"
                    . $objb->getFecha().";"
                    . $objb->getFechaIn().";"
                    . $objb->getAgencia().";"
                    . $objb->getNombreUser().$objb->getApellidoUser().";"
                    . $objb->getNomPax().";"
                    . $objb->getMoneda().";"
                    . round($objb->getTotal()).";"; 
                echo "\n\n";
                
               $objDBooking = $this->_booking->getDBooking($objb->getId());
               echo ";Status; Hotel; Habitación; P.A.; N°Hab; Adultos; Childs; Ciudad; Fecha In; Fecha Out; Total Venta;\n";
             foreach($objDBooking as $objdb){
               echo ";".$objdb->getEstado().";"
                       .$objdb->getHotel().";"
                       .$objdb->getTipoh().";"
                       .$objdb->getAgencia().";"
                       .$objdb->getPa().";"
                       .$objdb->getTot_hab().";"
                       .$objdb->getTot_pax().";"
                       .$objdb->getTot_child1().";"
                       .$objdb->getCiudad().";"
                       .$objdb->getFechaIn().";"
                       .$objdb->getFecha_out().";"
                       .round($objdb->getTotal_venta()).";";
                       echo "\n";                      
             }
              echo "\n";
             }   
        }
         public function anularBooking() {
        Session::acceso('Usuario');

        $this->_view->objCiudadesHotel = $this->_hotel->getCiudadesHot();
        $this->_view->objCiudadesServ = $this->_servicio->getCiudadesServ();
        $this->_view->objCiudadesPRG = $this->_programa->getCiudadesPRG();
        
        
        $this->_view->CR_fechaDesde = date('d/m/Y');
        if (Session::get('sess_pCR_fechaDesde')) {
            $this->_view->CR_fechaDesde = Session::get('sess_pCR_fechaDesde');
        }

        $this->_view->rdbRes = false;
        $this->_view->rdbVia = false;
        $this->_view->CR_fechaHasta = Funciones::sumFecha(date('d/m/Y'), 0, 3);
        if (Session::get('sess_pCR_tipoFecha') == 1) {
            $this->_view->rdbRes = 'checked';
        } else {
            $this->_view->rdbVia = 'checked';
        }

        $booking = $this->loadModel('booking');

        $this->_view->getBookings = $booking->getConsRes(
                Funciones::invertirFecha(Session::get('sess_pCR_fechaDesde'), '/', '-'), Funciones::invertirFecha(Session::get('sess_pCR_fechaHasta'), '/', '-'), Session::get('sess_pCR_tipoFecha'), Session::get('sess_id_agencia'), Session::getLevel('Admin'), Session::get('sess_usuario')
        );



        /* BEIGN: Paginador; */
        $pagina = 0;
        $pagina = $this->filtrarInt($pagina);
        $this->getLibrary('paginador');
        $paginador = new Paginador();
        /* $this->_view->getBookings=$paginador->paginar($booking->getConsRes(
          Funciones::invertirFecha(Session::get('sess_pCR_fechaDesde'), '/', '-'),
          Funciones::invertirFecha(Session::get('sess_pCR_fechaHasta'), '/', '-'),
          Session::get('sess_pCR_tipoFecha'),
          Session::get('sess_id_agencia'),
          Session::getLevel('Admin'),
          Session::get('sess_usuario')
          ), $pagina); */
        $this->_view->paginacion = $paginador->getView('prueba', 'sistema/consultarBooking');
        /* END: Paginador; */



        $this->_view->currentMenu = 6;
        $this->_view->titulo = 'ORISTRAVEL';
        $this->_view->renderizaSistema('anularBooking');
    }
    
    public function generaVoucherPdf($id){
    Session::acceso('Usuario');
    $this->getLibrary('fpdf');
    $pdfVou = new FPDF();
    $pdfVou->AddPage();
    $pdfVou->SetFont('Arial','B','11');
    $pdfVou->Cell(40,10,'Hola');
    $pdfVou->Output();   
    }
    
    
    public function paso3(){
    Session::acceso('Usuario');
    //if (strtolower($this->getServer('HTTP_X_REQUESTED_WITH')) == 'xmlhttprequest') {
    //$this->_view->carrAdltNombre = $this->getTexto('Carr_txtNombrePas_1_1');
    $objCarrPax = array();
            if(Session::get('sess_pBP_cntHab')){
                for($i = 1; $i<=Session::get('sess_pBP_cntHab'); $i++){


                        if(Session::get('sess_BP_Adl_'.$i)){
                               for($j = 1; $j <= Session::get('sess_BP_Adl_'.$i); $j++){
                                    $objCarroPax = new carroDTO();
                                    
                                    $objCarroPax->setHabitacion($i);
                                    if($this->getTexto('Carr_txtNombrePas_'.$i.'_'.$j)!="" & $this->getTexto('Carr_txtApellidoPas_'.$i.'_'.$j)!=""){
                                    $objCarroPax->setNombre($this->getTexto('Carr_txtNombrePas_'.$i.'_'.$j)); //$this->getTexto('Carr_txtNombrePas_'.$i.'_'.$j);                              
                                    $objCarroPax->setApellido($this->getTexto('Carr_txtApellidoPas_'.$i.'_'.$j)); //$this->getTexto('Carr_txtApellidoPas_'.$i.'_'.$j);   
                                     
                                    $objCarrPax[] = $objCarroPax;
                                   }
                                   else{
 
                                       throw new Exception("Error") ;          
                                      
                                   }
                                    
                                }
                                 
                        }
                }
                
               
                $this->_view->objTextoArea = $this->getTexto('Carr_textAreaNota');
                $this->_view->objPaxCarro = $objCarrPax;
                if($objCarroPax){
                $this->_view->objNombrePax  =  $objCarrPax[0]->getNombre();
                $this->_view->objApellidoPax  =  $objCarrPax[0]->getApellido();
                
               }
               else{
                   echo "asd";
                   
               }

            }
             $this->_view->objCarro = $this->_carro->getAddCarro(Session::get('sess_usuario'));

    $this->_view->renderizaCenterBox('paso3');
     
    }
    
   
     
/*     * *****************************************************************************
     *                                                                              *
     *                             METODOS PROCESADORES                             *
     *                                                                              *
     * ***************************************************************************** */

    public function salir() {
        Session::destroy();
        header('Location: ' . BASE_URL . 'login?ex');
        exit;
        /*
         * Session::destroy();
         * Session::destroy('sess_nombreUser');
         * Session::destroy(array('sess_nombreUser', 'otra'));
         */
    }

}

?>