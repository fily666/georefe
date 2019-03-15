<?php

namespace App\Controller;

use Cake\Event\Event;

class ReportesController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['datosbasicos', 'repotasistencia', 'reporteasistenciagl', 'reporte1pdf', 'reporte4pdf', 'reportegtajax', 'reporte3gtpdf', 'reporteverajax', 'reportedatospersonapdf',
            'reporte3verpdf', 'reportepeajax', 'reporte3pepdf', 'reporteexajax', 'reportejoajax', 'reporte3expdf', 'reporte3jopdf', 'datospersonaajax']);
    }

    //El reporte Lideres GT
    public function reporte1()
    {
        $this->loadModel('SiGts');
        $this->loadModel('Users');
        $this->loadModel('SiLideres');

        $rol = $this->Auth->user()['group_id'];
        if ($rol == 1) {
            $siGts = $this->SiGts->find('all')
                ->where(['SiGts.status_id <>' => 3])
            //->limit(300)
            //->page(1)
                ->contain(['Lider1', 'Lider1.Persons', 'SiPastores.Persons', 'DiaReunion', 'MaStatus', 'Categoria'])
                ->order(['SiGts.id' => 'DESC']);
        } else {
            $user = $this->Users->find('all')->select(['person_id'])
                ->where(['id' => $this->Auth->user()['id']])->first();

            $lider = $this->SiLideres->find('all')->select(['id'])
                ->where(['id_datos_basicos' => $user->person_id, 'id_nivel' => 207])->first();

            $siGts = $this->SiGts->find('all')
                ->where(['SiGts.id_lider_asignado1' => $lider->id,
                    'SiGts.status_id <>' => 3])
                ->contain(['Lider1', 'Lider1.Persons', 'SiPastores.Persons', 'DiaReunion', 'MaStatus', 'Categoria'])
                ->order(['SiGts.id' => 'DESC']);
        }

        //$this->pr($siGts); die;

        $this->set(compact('siGts'));
    }

    public function reporte1pdf($idGt = null)
    {

        $this->loadModel('SiGts');
        $this->loadModel('SiGtAsistencias');
        $this->loadModel('SiGtAsistentes');
        $this->loadModel('SiGtTemas');

        $this->viewBuilder()
            ->className('Dompdf.Pdf')
            ->layout('Dompdf.formatoReportes')
            ->options(
                ['config' => [
                    'filename' => 'Reporte_Lideres_GT.pdf',
                    'render' => 'download',
                    'orientation' => 'landscape',
                    'paginate' => [
                        'x' => 390,
                        'y' => 570,
                        "text" => "página {PAGE_NUM} de {PAGE_COUNT}",
                        'font-family' => 'initial',
                        'size' => 10,
                    ],
                ],
                ]);

        $siGtAsistentes = $this->SiGtAsistentes->find('all')
            ->select(['SiGtAsistentes.id', 'Persona.id', 'Persona.nombres', 'Persona.apellidos', 'Persona.documento'])
            ->where(['SiGtAsistentes.id_gt' => $idGt, 'SiGtAsistentes.status_id' => 1])
            ->contain(['Persona']);

        $siGtAsistencias = $this->SiGtAsistencias->find('all')
            ->where(['SiGtAsistentes.id_gt' => $idGt])
        //->limit(300)
        //->page(1)
            ->contain(['SiGtAsistentes', 'SiGtTemas.SiTemas'])
            ->order(['SiGtAsistencias.id' => 'ASC']);

        //$this->pr($siGtAsistentesExist); die;

        $gt = $this->SiGts->find('all')->where(['id' => $idGt])->first();
        $temas = $this->SiGtTemas->find('all')
            ->select(['SiTemas.tema', 'SiGtTemas.fecha'])
            ->where(['id_gt' => $idGt, 'SiGtTemas.status_id' => 1])
            ->contain(['SiTemas']);

        $this->set(compact('siGtAsistencias', 'siGtAsistentes', 'gt', 'temas', 'idGt'));
    }

    public function repotasistencia($idGt = null)
    {

        $this->loadModel('SiGts');
        $this->loadModel('SiGtAsistencias');
        $this->loadModel('SiGtAsistentes');
        $this->loadModel('SiGtTemas');

        $siGtAsistentes = $this->SiGtAsistentes->find('all')
            ->select(['SiGtAsistentes.id', 'Persona.id', 'Persona.nombres', 'Persona.apellidos', 'Persona.documento'])
            ->where(['SiGtAsistentes.id_gt' => $idGt, 'SiGtAsistentes.status_id' => 1])
            ->contain(['Persona']);

        if (count($siGtAsistentes->toArray()) > 0) {

            $siGtAsistencias = $this->SiGtAsistencias->find('all')
                ->where(['SiGtAsistentes.id_gt' => $idGt])
            //->limit(300)
            //->page(1)
                ->contain(['SiGtAsistentes', 'SiGtTemas.SiTemas'])
                ->order(['SiGtAsistencias.id' => 'ASC']);

            if (count($siGtAsistencias->toArray()) > 0) {

                //$this->pr($siGtAsistentesExist); die;

                $gt = $this->SiGts->find('all')->where(['id' => $idGt])->first();
                $temas = $this->SiGtTemas->find('all')
                    ->select(['SiTemas.tema', 'SiGtTemas.fecha'])
                    ->where(['id_gt' => $idGt, 'SiGtTemas.status_id' => 1])
                    ->contain(['SiTemas']);

                $this->set(compact('siGtAsistencias', 'siGtAsistentes', 'gt', 'temas'));
            } else {
                $this->Flash->error(__('No hay asistencia reportada para este GT.'), 'success');
                return $this->redirect(['action' => 'reporte1']);
            }
        } else {

            $this->Flash->error(__('No hay asistentes asociados a este GT.'), 'success');
            return $this->redirect(['action' => 'reporte1']);
        }
    }

    //Reporte Individual GT
    public function reporte2()
    {
        $this->loadModel('Persons');
        $personsdb = $this->Persons->find()->select(['id', 'documento', 'nombres', 'apellidos'])
            ->where(['status_id' => 1])
            ->order(['nombres' => 'ASC']);
        foreach ($personsdb as $person) {
            $lista1[$person['id']] = $person['documento'] . ' | ' . $person['nombres'] . ' ' . $person['apellidos'];
        } //Lista de personas a verificar
        $this->set(compact('lista1'));
    }

    public function datospersonaajax($id_persona)
    {
        $this->loadModel('Persons');
        $this->loadModel('SiVeriEntregas');
        $this->loadModel('SiPuntosEncuAsistentes');
        $this->loadModel('SiExodoAsistentes');
        $this->loadModel('SiJornadaAsistentes');
        $this->loadModel('SiGtAsistentes');
        $this->loadModel('SiGtAsistencias');

        $persona = $this->Persons->find('all')->select(['MaPropiedades.valor', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos',
            'Persons.direccion', 'Persons.email', 'Persons.telefono1', 'Persons.celular',
            'Persons.fotografia', 'Persons.status_id'])
            ->where(['Persons.id' => $id_persona])
            ->contain(['MaPropiedades'])->first();

        $verificaciones = $this->SiVeriEntregas->find('all')
            ->where(['SiVeriEntregas.id_datos_basicos' => $id_persona])
        //->limit(300)
        //->page(1)
            ->contain(['Persona', 'LiderAsignado.Persons', 'Guia', 'Pastor.Persons', 'EstadoLlamada'])
            ->order(['SiVeriEntregas.id' => 'DESC']);

        $siPuntoEncuentros = $this->SiPuntosEncuAsistentes->find('all')
            ->where(['SiPuntosEncuAsistentes.id_datos_basicos' => $id_persona])
        //->limit(300)
        //->page(1)
            ->contain(['SiPuntoEncuentros', 'SiPuntoEncuentros.Coordinador.Persons', 'SiPuntoEncuentros.MaPropiedades']);

        $siExodoAsistentes = $this->SiExodoAsistentes->find('all')
            ->where(['SiExodoAsistentes.id_datos_basicos' => $id_persona])
        //->limit(300)
        //->page(1)
            ->contain(['SiExodos', 'SiExodos.Coordinador.Persons', 'SiExodos.MaPropiedades']);

        $siJornadaAsistentes = $this->SiJornadaAsistentes->find('all')
            ->where(['SiJornadaAsistentes.id_datos_basicos' => $id_persona])
        //->limit(300)
        //->page(1)
            ->contain(['SiJornadas', 'SiJornadas.Coordinador.Persons', 'SiJornadas.MaPropiedades']);

        $siGts = $this->SiGtAsistentes->find('all')
            ->where(['SiGtAsistentes.id_datos_basicos' => $id_persona])
        //->limit(300)
        //->page(1)
            ->contain(['SiGts', 'SiGts.MaStatus', 'SiGts.Categoria', 'SiGts.SiPastores.Persons', 'SiGts.DiaReunion']);

        $siGtAsistencias = $this->SiGtAsistencias->find('all')
            ->where(['SiGtAsistencias.id_gt_asistente' => (count($siGts->toArray()) > 0) ? $siGts->toArray()[0]['id'] : 0])
            ->contain(['SiGtTemas.SiTemas']);
        //->limit(300)
        //->page(1)
        ;

        $this->set(compact('persona', 'id_persona', 'verificaciones', 'siPuntoEncuentros', 'siExodoAsistentes', 'siJornadaAsistentes', 'siGts', 'siGtAsistencias', 'siGtAsistencias'));
    }

    ///////////////////////////////7
    //Reporte Sin Muros Números
    public function reporte3()
    {
        $lista7 = $this->properties(1167); //Lista de procesos
        $this->set(compact('lista7'));
    }

    public function datosbasicos()
    {
        $this->loadModel('Persons');
        $this->viewBuilder()->layout();
        $persona = $this->Persons->find('all')->select(['MaPropiedades.valor', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos',
            'Persons.direccion', 'Persons.email', 'Persons.telefono1', 'Persons.celular',
            'Persons.fotografia', 'Persons.status_id'])
            ->where(['Persons.id' => $this->request->data['id']])
            ->contain(['MaPropiedades'])->first();

        $this->set(compact('persona'));
    }

    public function reportegtajax($fecha1, $fecha2)
    {
        $this->loadModel('SiGts');
        $this->loadModel('SiGtAsistentes');
        $siGts = $this->SiGts->find('all')
            ->where(['SiGts.status_id <>' => 3, 'fecha_inicia >=' => $fecha1, 'fecha_inicia <=' => $fecha2])
        //->limit(300)
        //->page(1)
            ->contain(['Lider1', 'SiPastores.Persons', 'DiaReunion', 'MaStatus', 'Categoria'])
            ->order(['SiGts.id' => 'DESC']);

        foreach ($siGts as $siGt) {
            $asistentesGt[$siGt->id] = count($this->SiGtAsistentes->find('all')->select(['id'])->where(['id_gt' => $siGt->id])->toArray());
        }

        $this->set(compact('siGts', 'asistentesGt', 'fecha1', 'fecha2'));
    }

    public function reporteverajax($fecha1, $fecha2)
    {
        $this->loadModel('SiVeriEntregas');
        $siVeriEntregas = $this->SiVeriEntregas->find('all')
            ->where(['SiVeriEntregas.status_id <>' => 3, 'fecha_entrega >=' => $fecha1, 'fecha_entrega <=' => $fecha2])
        //->limit(300)
        //->page(1)
            ->contain(['Persona', 'Pastor.Persons', 'LiderAsignado.Persons'])
            ->order(['SiVeriEntregas.id' => 'DESC']);

        $this->set(compact('siVeriEntregas', 'fecha1', 'fecha2'));
    }

    public function reportepeajax($fecha1, $fecha2)
    {
        $this->loadModel('SiPuntoEncuentros');
        $siPuntoEncuentros = $this->SiPuntoEncuentros->find('all')
            ->where(['SiPuntoEncuentros.status_id <>' => 3, 'SiPuntoEncuentros.fecha_inicio >=' => $fecha1, 'SiPuntoEncuentros.fecha_inicio <=' => $fecha2])
        //->limit(300)
        //->page(1)
            ->contain(['Coordinador.Persons', 'MaPropiedades', 'MaStatus'])
            ->order(['SiPuntoEncuentros.id' => 'DESC']);

        $this->set(compact('siPuntoEncuentros', 'fecha1', 'fecha2'));
    }

    public function reporteexajax($fecha1, $fecha2)
    {
        $this->loadModel('SiExodos');
        $siExodos = $this->SiExodos->find('all')
            ->where(['SiExodos.status_id <>' => 3, 'SiExodos.fecha_inicio >=' => $fecha1, 'SiExodos.fecha_inicio <=' => $fecha2])
        //->limit(300)
        //->page(1)
            ->contain(['Coordinador.Persons', 'MaPropiedades', 'MaStatus'])
            ->order(['SiExodos.id' => 'DESC']);

        $this->set(compact('siExodos', 'fecha1', 'fecha2'));
    }

    public function reportejoajax($fecha1, $fecha2)
    {
        $this->loadModel('SiJornadas');
        $siJornadas = $this->SiJornadas->find('all')
            ->where(['SiJornadas.status_id <>' => 3, 'SiJornadas.fecha_inicio >=' => $fecha1, 'SiJornadas.fecha_inicio <=' => $fecha2])
        //->limit(300)
        //->page(1)
            ->contain(['Coordinador.Persons', 'MaPropiedades', 'MaStatus'])
            ->order(['SiJornadas.id' => 'DESC']);

        $this->set(compact('siJornadas', 'fecha1', 'fecha2'));
    }

    public function reporte3gtpdf($fecha1, $fecha2)
    {

        $this->loadModel('SiGts');
        $this->loadModel('SiGtAsistentes');
        $this->loadComponent('Paginator');

        $this->viewBuilder()
            ->className('Dompdf.Pdf')
            ->layout('Dompdf.formatoReporteGT')
            ->options(
                ['config' => [
                    'filename' => 'Reporte_Sin_Muros_Numeros_GT.pdf',
                    'render' => 'download',
                    'orientation' => 'landscape',
                    'size' => 'A4',
                    'paginate' => [
                        'x' => 390,
                        'y' => 570,
                        "text" => "página {PAGE_NUM} de {PAGE_COUNT}",
                        'font-family' => 'initial',
                        'size' => 10,
                    ],
                ],
                ]);

        $siGts = $this->SiGts->find('all')
            ->where(['SiGts.status_id <>' => 3, 'fecha_inicia >=' => $fecha1, 'fecha_inicia <=' => $fecha2])
        //->limit(300)
        //->page(1)
            ->contain(['Lider1', 'SiPastores.Persons', 'DiaReunion', 'MaStatus', 'Categoria'])
            ->order(['SiGts.id' => 'DESC']);

        foreach ($siGts as $siGt) {
            $asistentesGt[$siGt->id] = count($this->SiGtAsistentes->find('all')->select(['id'])->where(['id_gt' => $siGt->id])->toArray());
        }

        $this->set(compact('siGts', 'asistentesGt', 'fecha1', 'fecha2'));
    }

    public function reporte3verpdf($fecha1, $fecha2)
    {
        $this->loadModel('SiVeriEntregas');
        $this->loadComponent('Paginator');

        $this->viewBuilder()
            ->className('Dompdf.Pdf')
            ->layout('Dompdf.formatoReporteGT')
            ->options(
                ['config' => [
                    'filename' => 'Reporte_Sin_Muros_Numeros_Veri.pdf',
                    'render' => 'download',
                    'orientation' => 'landscape',
                    'size' => 'A4',
                    'paginate' => [
                        'x' => 390,
                        'y' => 570,
                        "text" => "página {PAGE_NUM} de {PAGE_COUNT}",
                        'font-family' => 'initial',
                        'size' => 10,
                    ],
                ],
                ]);

        $siVeriEntregas = $this->SiVeriEntregas->find('all')
            ->where(['SiVeriEntregas.status_id <>' => 3, 'fecha_entrega >=' => $fecha1, 'fecha_entrega <=' => $fecha2])
        //->limit(300)
        //->page(1)
            ->contain(['Persona', 'Pastor.Persons', 'LiderAsignado.Persons'])
            ->order(['SiVeriEntregas.id' => 'DESC']);

        $this->set(compact('siVeriEntregas', 'fecha1', 'fecha2'));
    }

    public function reporte3pepdf($fecha1, $fecha2)
    {
        $this->loadModel('SiPuntoEncuentros');
        $this->loadComponent('Paginator');

        $this->viewBuilder()
            ->className('Dompdf.Pdf')
            ->layout('Dompdf.formatoReporteGT')
            ->options(
                ['config' => [
                    'filename' => 'Reporte_Sin_Muros_Numeros_PE.pdf',
                    'render' => 'download',
                    'orientation' => 'landscape',
                    'size' => 'A4',
                    'paginate' => [
                        'x' => 390,
                        'y' => 570,
                        "text" => "página {PAGE_NUM} de {PAGE_COUNT}",
                        'font-family' => 'initial',
                        'size' => 10,
                    ],
                ],
                ]);

        $siPuntoEncuentros = $this->SiPuntoEncuentros->find('all')
            ->where(['SiPuntoEncuentros.status_id <>' => 3, 'SiPuntoEncuentros.fecha_inicio >=' => $fecha1, 'SiPuntoEncuentros.fecha_inicio <=' => $fecha2])
        //->limit(300)
        //->page(1)
            ->contain(['Coordinador.Persons', 'MaPropiedades', 'MaStatus'])
            ->order(['SiPuntoEncuentros.id' => 'DESC']);

        $this->set(compact('siPuntoEncuentros', 'fecha1', 'fecha2'));
    }

    public function reporte3expdf($fecha1, $fecha2)
    {
        $this->loadModel('SiExodos');
        $this->loadComponent('Paginator');

        $this->viewBuilder()
            ->className('Dompdf.Pdf')
            ->layout('Dompdf.formatoReporteGT')
            ->options(
                ['config' => [
                    'filename' => 'Reporte_Sin_Muros_Numeros_EX.pdf',
                    'render' => 'download',
                    'orientation' => 'landscape',
                    'size' => 'A4',
                    'paginate' => [
                        'x' => 390,
                        'y' => 570,
                        "text" => "página {PAGE_NUM} de {PAGE_COUNT}",
                        'font-family' => 'initial',
                        'size' => 10,
                    ],
                ],
                ]);

        $siExodos = $this->SiExodos->find('all')
            ->where(['SiExodos.status_id <>' => 3, 'SiExodos.fecha_inicio >=' => $fecha1, 'SiExodos.fecha_inicio <=' => $fecha2])
        //->limit(300)
        //->page(1)
            ->contain(['Coordinador.Persons', 'MaPropiedades', 'MaStatus'])
            ->order(['SiExodos.id' => 'DESC']);

        $this->set(compact('siExodos', 'fecha1', 'fecha2'));
    }

    public function reporte3jopdf($fecha1, $fecha2)
    {
        $this->loadModel('SiJornadas');
        $this->loadComponent('Paginator');

        $this->viewBuilder()
            ->className('Dompdf.Pdf')
            ->layout('Dompdf.formatoReporteGT')
            ->options(
                ['config' => [
                    'filename' => 'Reporte_Sin_Muros_Numeros_JO.pdf',
                    'render' => 'download',
                    'orientation' => 'landscape',
                    'size' => 'A4',
                    'paginate' => [
                        'x' => 390,
                        'y' => 570,
                        "text" => "página {PAGE_NUM} de {PAGE_COUNT}",
                        'font-family' => 'initial',
                        'size' => 10,
                    ],
                ],
                ]);

        $siJornadas = $this->SiJornadas->find('all')
            ->where(['SiJornadas.status_id <>' => 3, 'SiJornadas.fecha_inicio >=' => $fecha1, 'SiJornadas.fecha_inicio <=' => $fecha2])
        //->limit(300)
        //->page(1)
            ->contain(['Coordinador.Persons', 'MaPropiedades', 'MaStatus'])
            ->order(['SiJornadas.id' => 'DESC']);

        $this->set(compact('siJornadas', 'fecha1', 'fecha2'));
    }

    public function reportedatospersonapdf($id_persona)
    {
        $this->loadModel('Persons');
        $this->loadModel('SiVeriEntregas');
        $this->loadModel('SiPuntosEncuAsistentes');
        $this->loadModel('SiExodoAsistentes');
        $this->loadModel('SiJornadaAsistentes');
        $this->loadModel('SiGtAsistentes');
        $this->loadModel('SiGtAsistencias');
        $this->loadComponent('Paginator');

        $this->viewBuilder()
            ->className('Dompdf.Pdf')
            ->layout('Dompdf.formatoReporteGT')
            ->options(
                ['config' => [
                    'filename' => 'Reporte_Sin_Muros_Individual.pdf',
                    'render' => 'download',
                    'orientation' => 'landscape',
                    'size' => 'A4',
                    'paginate' => [
                        'x' => 390,
                        'y' => 570,
                        "text" => "página {PAGE_NUM} de {PAGE_COUNT}",
                        'font-family' => 'initial',
                        'size' => 10,
                    ],
                ],
                ]);

        $persona = $this->Persons->find('all')->select(['MaPropiedades.valor', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos',
            'Persons.direccion', 'Persons.email', 'Persons.telefono1', 'Persons.celular',
            'Persons.fotografia', 'Persons.status_id'])
            ->where(['Persons.id' => $id_persona])
            ->contain(['MaPropiedades'])->first();

        $verificaciones = $this->SiVeriEntregas->find('all')
            ->where(['SiVeriEntregas.id_datos_basicos' => $id_persona])
        //->limit(300)
        //->page(1)
            ->contain(['Persona', 'LiderAsignado.Persons', 'Guia', 'Pastor.Persons', 'EstadoLlamada'])
            ->order(['SiVeriEntregas.id' => 'DESC']);

        $siPuntoEncuentros = $this->SiPuntosEncuAsistentes->find('all')
            ->where(['SiPuntosEncuAsistentes.id_datos_basicos' => $id_persona])
        //->limit(300)
        //->page(1)
            ->contain(['SiPuntoEncuentros', 'SiPuntoEncuentros.Coordinador.Persons', 'SiPuntoEncuentros.MaPropiedades']);

        $siExodoAsistentes = $this->SiExodoAsistentes->find('all')
            ->where(['SiExodoAsistentes.id_datos_basicos' => $id_persona])
        //->limit(300)
        //->page(1)
            ->contain(['SiExodos', 'SiExodos.Coordinador.Persons', 'SiExodos.MaPropiedades']);

        $siJornadaAsistentes = $this->SiJornadaAsistentes->find('all')
            ->where(['SiJornadaAsistentes.id_datos_basicos' => $id_persona])
        //->limit(300)
        //->page(1)
            ->contain(['SiJornadas', 'SiJornadas.Coordinador.Persons', 'SiJornadas.MaPropiedades']);

        $siGts = $this->SiGtAsistentes->find('all')
            ->where(['SiGtAsistentes.id_datos_basicos' => $id_persona])
        //->limit(300)
        //->page(1)
            ->contain(['SiGts', 'SiGts.MaStatus', 'SiGts.Categoria', 'SiGts.SiPastores.Persons', 'SiGts.DiaReunion']);

        $siGtAsistencias = $this->SiGtAsistencias->find('all')
            ->where(['SiGtAsistencias.id_gt_asistente' => (count($siGts->toArray()) > 0) ? $siGts->toArray()[0]['id'] : 0])
            ->contain(['SiGtTemas.SiTemas']);
        //->limit(300)
        //->page(1)
        ;

        $this->set(compact('persona', 'verificaciones', 'siPuntoEncuentros', 'siExodoAsistentes', 'siJornadaAsistentes', 'siGts', 'siGtAsistencias', 'siGtAsistencias'));
    }

        //Reporte Lideres Grupo Liderazgo
        public function reporte4()
        {
            $this->loadModel('SiGls');
            $this->loadModel('Users');
            $this->loadModel('SiLideres');
    
            $rol = $this->Auth->user()['group_id'];
            if ($rol == 1) {
                $siGls = $this->SiGls->find('all')
                    ->where(['SiGls.status_id <>' => 3])
                //->limit(300)
                //->page(1)
                    ->contain(['Lider', 'Lider.Persons', 'SiPastores.Persons', 'DiaReunion', 'MaStatus', 'Categoria'])
                    ->order(['SiGls.id' => 'DESC']);
            } else {
                $user = $this->Users->find('all')->select(['person_id'])
                    ->where(['id' => $this->Auth->user()['id']])->first();
    
                $lider = $this->SiLideres->find('all')->select(['id'])
                    ->where(['id_datos_basicos' => $user->person_id, 'id_nivel' => 1173])->first();
    
                $siGls = $this->SiGls->find('all')
                    ->where(['SiGls.id_lider' => $lider->id,
                        'SiGls.status_id <>' => 3])
                    ->contain(['Lider', 'Lider.Persons', 'SiPastores.Persons', 'DiaReunion', 'MaStatus', 'Categoria'])
                    ->order(['SiGls.id' => 'DESC']);
            }
    
            $this->set(compact('siGls'));
        }
    
        public function reporte4pdf($idGl = null)
        {
    
            $this->loadModel('SiGls');
            $this->loadModel('SiGlAsistencias');
            $this->loadModel('SiGlAsistentes');
            $this->loadModel('SiGlTemas');
    
            $this->viewBuilder()
                ->className('Dompdf.Pdf')
                ->layout('Dompdf.formatoReportes')
                ->options(
                    ['config' => [
                        'filename' => 'Reporte_Lideres_Grupo_Liderazgo.pdf',
                        'render' => 'download',
                        'orientation' => 'landscape',
                        'paginate' => [
                            'x' => 390,
                            'y' => 570,
                            "text" => "página {PAGE_NUM} de {PAGE_COUNT}",
                            'font-family' => 'initial',
                            'size' => 10,
                        ],
                    ],
                    ]);
    
            $siGlAsistentes = $this->SiGlAsistentes->find('all')
                ->select(['SiGlAsistentes.id', 'Persona.id', 'Persona.nombres', 'Persona.apellidos', 'Persona.documento'])
                ->where(['SiGlAsistentes.id_gl' => $idGl, 'SiGlAsistentes.status_id' => 1])
                ->contain(['Persona']);
    
            $siGlAsistencias = $this->SiGlAsistencias->find('all')
                ->where(['SiGlAsistentes.id_gl' => $idGl])
            //->limit(300)
            //->page(1)
                ->contain(['SiGlAsistentes', 'SiGlTemas.SiTemas'])
                ->order(['SiGlAsistencias.id' => 'ASC']);
    
            $gl = $this->SiGls->find('all')->where(['id' => $idGl])->first();
            $temasgl = $this->SiGlTemas->find('all')
                ->select(['SiTemas.tema', 'SiGlTemas.fecha'])
                ->where(['id_gl' => $idGl, 'SiGlTemas.status_id' => 1])
                ->contain(['SiTemas']);
    
            $this->set(compact('siGlAsistencias', 'siGlAsistentes', 'gl', 'temasgl', 'idGl'));
        }
    
        public function reporteasistenciagl($idGl = null)
        {
    
            $this->loadModel('SiGls');
            $this->loadModel('SiGlAsistencias');
            $this->loadModel('SiGlAsistentes');
            $this->loadModel('SiGlTemas');
    
            $siGlAsistentes = $this->SiGlAsistentes->find('all')
                ->select(['SiGlAsistentes.id', 'Persona.id', 'Persona.nombres', 'Persona.apellidos', 'Persona.documento'])
                ->where(['SiGlAsistentes.id_gl' => $idGl, 'SiGlAsistentes.status_id' => 1])
                ->contain(['Persona']);
    
            if (count($siGlAsistentes->toArray()) > 0) {
    
                $siGlAsistencias = $this->SiGlAsistencias->find('all')
                    ->where(['SiGlAsistentes.id_gl' => $idGl])
                //->limit(300)
                //->page(1)
                    ->contain(['SiGlAsistentes', 'SiGlTemas.SiTemas'])
                    ->order(['SiGlAsistencias.id' => 'ASC']);
    
                if (count($siGlAsistencias->toArray()) > 0) {
    
                    $gl = $this->SiGls->find('all')->where(['id' => $idGl])->first();
                    $temasgl = $this->SiGlTemas->find('all')
                        ->select(['SiTemas.tema', 'SiGlTemas.fecha'])
                        ->where(['id_gl' => $idGl, 'SiGlTemas.status_id' => 1])
                        ->contain(['SiTemas']);
    
                    $this->set(compact('siGlAsistencias', 'siGlAsistentes', 'gl', 'temasgl'));
                } else {
                    $this->Flash->error(__('No hay asistencia reportada para este Grupo de liderazgo.'), 'success');
                    return $this->redirect(['action' => 'reporte4']);
                }
            } else {
    
                $this->Flash->error(__('No hay asistentes asociados a este Grupo de liderazgo.'), 'success');
                return $this->redirect(['action' => 'reporte4']);
            }
        }

        //Reporte Consolidacion
        public function reporte5()
        {   
            $this->loadModel('SiVeriEntregas');            
            date_default_timezone_set('America/Bogota');
            $fechaActual = date('Y-m-d');
            $fechaRequerida = date('Y-m-d',strtotime($fechaActual.'- 8 days'));
            //echo "##FECHA ACTUAL $fechaActual  ######### FECHA REQUERIDA  $fechaRequerida";
            $siverientregas = $this->SiVeriEntregas->find('all')
            ->where(['SiVeriEntregas.status_id IN' => [1, 2],
            'SiVeriEntregas.id_estado_llamada IN' => [251, 252],
            'SiVeriEntregas.fecha_entrega <=' => $fechaRequerida])
            ->contain(['Persona', 'LiderLlamada.Persons', 'LiderConsolida.Persons', 'Pastor.Persons', 'EstadoLlamada'])
            ->order(['SiVeriEntregas.id' => 'DESC']);

            $this->set(compact('siverientregas'));
        }

        public function editconsolida($id = null)
        {
            //Carga de entidades a usar
            $this->loadModel('SiVeriEntregas');
            $this->loadModel('Persons');
            $this->loadModel('SiVeriEntregas');
            $this->loadModel('SiPuntosEncuAsistentes');
            $this->loadModel('SiExodoAsistentes');
            $this->loadModel('SiJornadaAsistentes');
            $this->loadModel('SiGtAsistentes');
            $this->loadModel('SiGtAsistencias');
            $this->loadModel('SiLideres');
            $this->loadModel('SiPastores');

            $verificacion = $this->SiVeriEntregas->find('all')->where(['id' => $id])->first();            

            if ($this->request->is(['post', 'put'])) {
                $verificacion = $this->SiVeriEntregas->patchEntity($verificacion, $this->request->data);

                $verificacion->modifier_id = $this->Auth->user()['id'];
                if ($this->SiVeriEntregas->save($verificacion)) {
                    $this->Flash->success(__('Los datos de verificación han sido editados.'), 'success');
                    return $this->redirect(['action' => 'reporte5']);
                }
                $this->Flash->error(__('No se pudo editar los datos de verificación.'));
            }

            $persona = $this->Persons->find('all')->select(['MaPropiedades.valor', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos',
                'Persons.direccion', 'Persons.email', 'Persons.telefono1', 'Persons.celular', 'Persons.status_id'])
                ->where(['Persons.id' => $verificacion->id_datos_basicos])
                ->contain(['MaPropiedades'])->first();

            $lideresgt = $this->SiLideres->find()->select(['SiLideres.id', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos'])
                ->where(['SiLideres.id_nivel' => 207, 'SiLideres.status_id' => 1])
                ->contain(['Persons'])
                ->order(['Persons.nombres' => 'ASC']);

            foreach ($lideresgt as $lidergt) {
                $lista1[$lidergt['id']] = $lidergt['person']['documento'] . ' | ' . $lidergt['person']['nombres'] . ' ' . $lidergt['person']['apellidos'];
            } //Lista para Lideres de GT

            $liderconsolida = $this->SiLideres->find()->select(['SiLideres.id', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos'])
                ->where(['SiLideres.id_nivel' => 1179, 'SiLideres.status_id' => 1])
                ->contain(['Persons'])
                ->order(['Persons.nombres' => 'ASC']);

            foreach ($liderconsolida as $liderco) {
                $lista2[$liderco['id']] = $liderco['person']['documento'] . ' | ' . $liderco['person']['nombres'] . ' ' . $liderco['person']['apellidos'];
            } //Lista para encargados de llamada

            $pastoresdb = $this->SiPastores->find()->select(['SiPastores.id', 'Persons.documento', 'Persons.nombres', 'Persons.apellidos'])
                ->where(['SiPastores.status_id' => 1])
                ->contain(['Persons'])
                ->order(['Persons.nombres' => 'ASC']);

            foreach ($pastoresdb as $pastor) {
                $lista3[$pastor['id']] = $pastor['person']['documento'] . ' | ' . $pastor['person']['nombres'] . ' ' . $pastor['person']['apellidos'];
            } //Lista para pastores

            //Parametros que se envian a la vista
            $this->set(compact('verificacion','persona', 'lista1', 'lista2', 'lista3'));
        }

        //Reporte Grupos por barrio
        public function reporte6()
        {   
            $this->loadModel('SiGts');
            
            $siGts = $this->SiGts->find('all')
                ->where(['SiGts.status_id <>' => 3])
                ->contain(['Lider1', 'Lider1.Persons', 'SiPastores.Persons', 'DiaReunion', 'Barrio', 'Localidad', 'MaStatus', 'Categoria'])
                ->order(['SiGts.id' => 'DESC']);
            $this->set(compact('siGts'));            
        }

        //Reporte Lider Acompañamiento GT
        public function reporte7()
        {   
            $this->loadModel('Users');
            $this->loadModel('SiLideres');
            $this->loadModel('SiGts');
            $rol = $this->Auth->user()['group_id'];
            if ($rol == 1) {
                $siGts = $this->SiGts->find('all')
                    ->where(['SiGts.status_id <>' => 3])
                    ->contain(['Lider1', 'Lider1.Persons', 'Lider2', 'Lider2.Persons','SiPastores.Persons', 'DiaReunion', 'MaStatus', 'Categoria'])
                    ->order(['SiGts.id' => 'DESC']);
            } else {
                $user = $this->Users->find('all')->select(['person_id'])
                ->where(['id' => $this->Auth->user()['id']])->first();

                $lider = $this->SiLideres->find('all')->select(['id'])
                    ->where(['id_datos_basicos' => $user->person_id, 'id_nivel' => 209])->first();
                if($lider){
                    $siGts = $this->SiGts->find('all')
                    ->where(['SiGts.id_lider_asignado2' => $lider->id,
                        'SiGts.status_id <>' => 3])
                    ->contain(['Lider1', 'Lider1.Persons', 'Lider2', 'Lider2.Persons', 'SiPastores.Persons', 'DiaReunion', 'MaStatus', 'Categoria'])
                    ->order(['SiGts.id' => 'DESC']);
                }else{
                    $siGts = $this->SiGts->newEntity();
                    $this->Flash->error(__('No esta registrado como lider de acompañamiento, contacte al Administrador')); 
                }
            }         
            $this->set(compact('siGts'));
        }

        public function asistenciagt($idGt = null)
        {

            $this->loadModel('SiGtAsistencias');
            $this->loadModel('SiGtAsistentes');
            $this->loadModel('SiGtTemas');
            $this->loadModel('SiGts');

            $siGtAsistentes = $this->SiGtAsistentes->find('all')
                ->select(['SiGtAsistentes.id', 'Persona.id', 'Persona.nombres', 'Persona.apellidos', 'Persona.documento'])
                ->where(['SiGtAsistentes.id_gt' => $idGt, 'SiGtAsistentes.status_id' => 1])
                ->contain(['Persona']);

            if (count($siGtAsistentes->toArray()) > 0) {
                $siGtAsistencias = $this->SiGtAsistencias->find('all')
                    ->where(['SiGtAsistentes.id_gt' => $idGt])
                    ->contain(['SiGtAsistentes', 'SiGtTemas.SiTemas'])
                    ->order(['SiGtAsistencias.id' => 'ASC']);
                $temas = $this->SiGtTemas->find('all')
                    ->select(['SiTemas.tema', 'SiGtTemas.fecha'])
                    ->where(['id_gt' => $idGt, 'SiGtTemas.status_id' => 1])
                    ->contain(['SiTemas']);

                $gt = $this->SiGts->find('all')->where(['id' => $idGt])->first();

                $this->set(compact('siGtAsistencias', 'siGtAsistentes', 'temas', 'gt'));
            } else {
                $this->Flash->error(__('No existen asistentes asociados al GT.'), 'success');
                return $this->redirect(['action' => 'reporte7']);
            }
        }

}
