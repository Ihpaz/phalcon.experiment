
{{ content() }}

<form action="/barang/create" method="POST">

    <ul class="pager">
        <li class="previous pull-left">
            {{ link_to("/", "&larr; Go Back") }}
        </li>
        <li class="pull-left">
            {{ submit_button("Save", "class": "btn btn-success") }}
        </li>
    </ul>

    <fieldset>
    
    <div class="panel panel-default" style="width: 500px;margin-left: 20px; ">
        <div class="panel-heading">
           ADD BARANG   
        </div>

        <div class='panel-body' style="width: 400px;  margin: auto;">
          
            {% for element in form %}
            
                <div class="row">
                    <div class="col-sm-10 col-md-10 col-lg-10 col-xs-10">
                        <div class="form-group">
                            {{ element.label() }}
                            {% if loop.first %}
                                {{ element.render(['class': 'form-control','readonly':'true']) }}
                            {% else %} 
                                {{ element.render(['class': 'form-control']) }}
                            {% endif %}
                        </div>
                    </div>
                </div>
                
            {% endfor %}
        </div>
    </div>
    </fieldset>

</form>

