<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!-- <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> -->
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="css/application.css">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.css">
  </head>
  <body ng-app="SinpploApp" >

    <div ng-controller="Index" layout="column"  >
      <div class="loading" layout-align="center center">
        <md-progress-circular md-mode="indeterminate" ng-show="isLoading"  md-diameter="100"></md-progress-circular>
      </div>

      <section layout="row" layout-align="center center" >
        <md-content flex="40" layout-padding layout="column" class="mt-2">
          <md-button  ng-href="view_api.html" class="md-raised md-primary">
            Ir a la api
          </md-button>

          <h3 class="text-center"> ó </h3>

          <md-input-container class="md-block">
             <label>Ingresa una url del sitio Aviso de Ocación para analizar (Carros)</label>
             <input  required md-no-asterisk name="description" ng-model="request_url">
             <div ng-messages="projectForm.description.$error">
               <div ng-message="required">This is required.</div>

             </div>
           </md-input-container>

           <div layout="row" layout-align="end center">

             <md-button ng-show="items_ads.length > 0" ng-click="insertData()" class="md-raised md-primary">
               Insertar datos en la base de datos
             </md-button>

             <md-button ng-show="items_ads.length > 0" ng-click="goToScript()" class="md-raised md-primary">
               Ver resultados (JSON)
             </md-button>

             <md-button ng-click="getData()" class="md-raised md-primary">
               Procesar
             </md-button>
           </div>

           <div layout="row">
             <!-- Place this tag where you want the button to render. -->
             <a class="github-button" href="https://github.com/LuisDominguez/example_simpplo" data-icon="octicon-cloud-download" data-size="large" aria-label="Download LuisDominguez/example_simpplo on GitHub">Descargar Código</a>

           </div>

        </md-content>
      </section>

      <section layout="row" layout-align="center center" ng-init="getData()">

        <md-content layout="row" layout-wrap layout-padding class="transparent" layout-align="center center">
          <md-card flex="20" ng-repeat="item_ad in items_ads">
            <img ng-src="{{item_ad.image}}" class="md-card-image" err-src="http://www.newcarselloff.com/listings/images/default-car.png" alt="Washed Out">
            <md-card-title>
              <md-card-title-text>
                <span class="md-headline">{{item_ad.name}}</span>
              </md-card-title-text>
            </md-card-title>
            <md-card-content>
              <p>
                {{item_ad.price}}
              </p>
            </md-card-content>
            <md-card-actions layout="row" layout-align="end center">

            </md-card-actions>
          </md-card>

        </md-content>
      </section>

    </div>
  </body>

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <!-- Angular Material requires Angular.js Libraries -->
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular.min.js" data-turbolinks-eval='false' ></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-animate.min.js" data-turbolinks-eval='false' ></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-aria.min.js" data-turbolinks-eval='false' ></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-messages.min.js" data-turbolinks-eval='false' ></script>


  <!-- Angular Material Library -->
  <script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.js" data-turbolinks-eval='false' ></script>


  <script src="js/application.js" charset="utf-8"></script>
</html>
