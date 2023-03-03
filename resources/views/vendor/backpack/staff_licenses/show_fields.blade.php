@php
$licenses = \App\Models\License::get();    
@endphp

<div class="row" align="left">
    <div class="col-6">
      <div class="form-group">
        <label for="name">Artículo <label class="text-danger">*</label></label>
        <select class="form-control form-select" id="articulo" name="license_id">
          <option value="">Seleccione</option>
          @foreach ($licenses as $license)
            <option value="{{ $license->id }}">{{ $license->article }}</option>
          @endforeach
        </select>
      </div>
    </div>

    <input class="form-control" type="hidden" value="75" name="staff_id"></input>
    <input class="form-control" type="hidden" value="{{ auth()->user()->id }}" name="user_id"></input>
    <input class="form-control" type="hidden" value="Solicitada" name="status"></input>
    
    <div class="col-6">
      <div class="form-group">
        <label for="name">Días Solicitados <label class="text-danger">*</label></label>
        <input class="form-control" type="number" id="dias_solicitados" name="requested_days"></input>
      </div>
    </div>

    <div class="col-6">
        <div class="form-group">
          <label for="name">Fecha de Solicitud <label class="text-danger">*</label></label>
          <input class="form-control" type="date" id="fecha_solicitud" name="application_date"></input>
        </div>
      </div>
      
      <div class="col-6">
        <div class="form-group">
          <label for="name">Fecha de Autorización <label class="text-danger">*</label></label>
          <input class="form-control" type="date" id="fecha_autorizacion" name="authorized_date"></input>
        </div>
      </div>

      <div class="col-6">
        <div class="form-group">
          <label for="name">Fecha Inicio <label class="text-danger">*</label></label>
          <input class="form-control" type="date" id="fecha_inicio" name="start_date"></input>
        </div>
      </div>

      <div class="col-6">
        <div class="form-group">
          <label for="name">Fecha Fin <label class="text-danger">*</label></label>
          <input class="form-control" type="date" id="fecha_fin" name="	end_date"></input>
        </div>
      </div>

      <div class="col-12">
        <div class="form-group">
          <label for="name">Observaciones <label class="text-danger">*</label></label>
          <textarea class="form-control" id="obs" name="observations"></textarea>
        </div>
      </div>
      
      

    @if(isset($saveAction['active']) && !is_null($saveAction['active']['value']))
        <div id="saveActions" class="form-group">
            <input type="hidden" name="save_action" value="{{ $saveAction['active']['value'] }}">
            @if(!empty($saveAction['options']))
                <div class="btn-group" role="group">
            @endif

            <button type="submit" class="btn btn-success" action="licenses">
                <span class="la la-save" role="presentation" aria-hidden="true"></span> &nbsp;
                <span data-value="{{ $saveAction['active']['value'] }}">{{ $saveAction['active']['label'] }}</span>
            </button>

            <div class="btn-group" role="group">
                @if(!empty($saveAction['options']))
                    <button id="btnGroupDrop1" type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span><span class="sr-only">&#x25BC;</span></button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        @foreach( $saveAction['options'] as $value => $label)
                        <a class="dropdown-item" href="javascript:void(0);" data-value="{{ $value }}">{{ $label }}</a>
                        @endforeach
                    </div>
                @endif
            </div>

            @if(!empty($saveAction['options']))
                </div>
            @endif

            {{--@if(!$crud->hasOperationSetting('showCancelButton') || $crud->getOperationSetting('showCancelButton') == true)
                <a href="{{ $crud->hasAccess('list') ? url($crud->route) : url()->previous() }}" class="btn btn-default"><span class="la la-ban"></span> &nbsp;{{ trans('backpack::crud.cancel') }}</a>
            @endif--}}

        </div>
    @endif


</div>