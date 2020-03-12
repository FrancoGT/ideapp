/* COMPONENTES */
Vue.component('modal',{ //modal
  template:`
    <transition
              enter-active-class="animated rollIn"
                   leave-active-class="animated rollOut">
  <div class="modal is-active" >
<div class="modal-card border border border-secondary">
  <div class="modal-card-head text-center bg-dark">
  <div class="modal-card-title text-white">
        <slot name="head"></slot>
  </div>
<button class="delete" @click="$emit('close')"></button>
  </div>
  <div class="modal-card-body">
       <slot name="body"></slot>
  </div>
  <div class="modal-card-foot" >
    <slot name="foot"></slot>
  </div>
</div>
</div>
</transition>
  `
})

Vue.component('modal_proyecto_construccion',{ //modal
  template:`
    <transition
              enter-active-class="animated rollIn"
                   leave-active-class="animated rollOut">
  <div class="modal is-active" >
<div class="modal-card border border border-secondary">
  <div class="modal-card-head text-center bg-dark">
  <div class="modal-card-title text-white">
        <slot name="head"></slot>
  </div>
<button class="delete" @click="$emit('close')"></button>
  </div>
  <div class="modal-card-body">
       <slot name="body"></slot>
  </div>
  <div class="modal-card-foot" >
    <slot name="foot"></slot>
  </div>
</div>
</div>
</transition>`
})

/* OBJETO VUEJS */

var v = new Vue({
  el:'#app',
  data: {
    url:'http://localhost/ideapp/',
    addModal: false,
    editModal:false,
    deleteModal:false,
    users:[],

    items_proyecto_construccion:[],

    search: {text: ''},
    emptyResult:false,
    newUser:
    {
      firstname:'',
      lastname:'',
      gender:'',
      birthday:'',
      email:'',
      contact:'',
      address:''
    },

    newProyecto_construccion:
    {
      nombre_proyecto:'',
      fecha_inicio:'',
      fecha_fin:'',
      estado_proyecto:''
    },

    chooseUser:{},
    
    chooseProyecto_construccion:{},

    formValidate:[],
    successMSG:'',
     
    //pagination
    currentPage: 0,
    rowCountPage:5,
    totalUsers:0,
    
    totalItems_proyecto_construccion:0,

    pageRange:2
  },
  created()
  {
    if (document.URL=="http://localhost/ideapp/user")
    {
      this.showAll(); 
    }
    if (document.URL=="http://localhost/ideapp/index.php/servicio/modulo_obras_construccion")
    {
      this.mostrar_items_proyecto_construccion();
    }
  },
  methods:
  {
    //METODOS: MOSTRAR INFORMACION
    showAll()
    { 
      axios.get(this.url+"user/showAll").then(function(response)
      {
        if(response.data.users == null)
        {
          v.noResult()
        }
        else
        {
          v.getData(response.data.users);
        }
      })
    },

    mostrar_items_proyecto_construccion()
    { 
      axios.get(this.url+"proyecto_construccion/mostrar_items_proyecto_construccion").then(function(response)
      {
        if(response.data.items_proyecto_construccion == null)
        {
          v.noResultProyecto_construccion()
        }
        else
        {
          v.getDataProyecto_construccion(response.data.items_proyecto_construccion);
        }
      })
    },

    //METODOS: BUSQUEDA
    searchUser()
    {
      var formData = v.formData(v.search);
      axios.post(this.url+"user/searchUser", formData).then(function(response)
      {
        if(response.data.users == null)
        {
          v.noResult()
        }
        else
        {
          v.getData(response.data.users);
        }  
      })
    },

    searchProyecto_construccion()
    {
      var formData = v.formData(v.search);
      axios.post(this.url+"proyecto_construccion/searchProyecto_construccion", formData).then(function(response)
      {
        if(response.data.items_proyecto_construccion == null)
        {
          v.noResult()
        }
        else
        {
          v.getDataProyecto_construccion(response.data.items_proyecto_construccion);
        }  
      })
    },

    //METODOS: INSERCION
    addUser()
    {   
      var formData = v.formData(v.newUser);
      axios.post(this.url+"user/addUser", formData).then(function(response)
      {
        if(response.data.error)
        {
          v.formValidate = response.data.msg;
        }
        else
        {
          v.successMSG = response.data.msg;
          v.clearAll();
          v.clearMSG();
        }
      })
    },

    addProyecto_construccion()
    {   
      var formData = v.formData(v.newProyecto_construccion);
      axios.post(this.url+"proyecto_construccion/addProyecto_construccion", formData).then(function(response)
      {
        if(response.data.error)
        {
          v.formValidate = response.data.msg;
        }
        else
        {
          v.successMSG = response.data.msg;
          v.clearAll();
          v.clearMSG();
        }
      })
    },

    //METODOS: ACTUALIZACION
    updateUser()
    {
      var formData = v.formData(v.chooseUser); axios.post(this.url+"user/updateUser", formData).then(function(response)
      {
        if(response.data.error)
        {
          v.formValidate = response.data.msg;
        }
        else
        {
          v.successMSG = response.data.success;
          v.clearAll();
          v.clearMSG();
        }
      })
    },

    updateProyecto_construccion()
    {
      var formData = v.formData(v.chooseProyecto_construccion); 
      axios.post(this.url+"proyecto_construccion/updateProyecto_construccion", formData).then(function(response)
      {
        if(response.data.error)
        {
          v.formValidate = response.data.msg;
        }
        else
        {
          v.successMSG = response.data.success;
          v.clearAll();
          v.clearMSG();
        }
      })
    },

    //METODOS: ELIMINACION
    deleteUser()
    {
      var formData = v.formData(v.chooseUser);
      axios.post(this.url+"user/deleteUser", formData).then(function(response)
      {
        if(!response.data.error)
        {
          v.successMSG = response.data.success;
          v.clearAll();
          v.clearMSG();
        }
      })
    },

    deleteProyecto_construccion()
    {
      var formData = v.formData(v.chooseProyecto_construccion);
      axios.post(this.url+"proyecto_construccion/deleteProyecto_construccion", formData).then(function(response)
      {
        if(!response.data.error)
        {
          v.successMSG = response.data.success;
          v.clearAll();
          v.clearMSG();
        }
      })
    },

    //METODO AUXILIAR
    formData(obj)
    {
      var formData = new FormData();
      for ( var key in obj ) 
      {
        formData.append(key, obj[key]);
      } 
      return formData;
    },

    //METODOS: GETDATA
    getData(users)
    {
      v.emptyResult = false; // become false if has a record
      v.totalUsers = users.length //get total of user
      v.users = users.slice(v.currentPage * v.rowCountPage, (v.currentPage * v.rowCountPage) + v.rowCountPage); //slice the result for pagination
            
      // if the record is empty, go back a page
      if(v.users.length == 0 && v.currentPage > 0)
      { 
        v.pageUpdate(v.currentPage - 1)
        v.clearAll();  
      }
    },

    getDataProyecto_construccion(items_proyecto_construccion)
    {
      v.emptyResult = false; // Es false si tiene un registro
      v.totalItems_proyecto_construccion = items_proyecto_construccion.length //obtener el total de los Proyectos de construccion
      v.items_proyecto_construccion = items_proyecto_construccion.slice(v.currentPage * v.rowCountPage, (v.currentPage * v.rowCountPage) + v.rowCountPage); //slice the result for pagination
            
      // si el registro está vacío, regresa una página
      if(v.items_proyecto_construccion.length == 0 && v.currentPage > 0)
      { 
        v.pageUpdateProyecto_construccion(v.currentPage - 1)
        v.clearAll();  
      }
    },

    //METODOS: SELECT
    selectUser(user)
    {
      v.chooseUser = user; 
    },

    selectProyecto_construccion(proyecto_construccion)
    {
      v.chooseProyecto_construccion = proyecto_construccion; 
    },

    //METODO AUXILIAR
    clearMSG()
    {
      setTimeout(function()
      {
      v.successMSG=''
      },3000); // disappearing message success in 2 sec
    },

    //METODOS: clearAll
    clearAll()
    {
      v.newUser = { 
        firstname:'',
        lastname:'',
        gender:'',
        birthday:'',
        email:'',
        contact:'',
        address:''
      };
      v.formValidate = false;
      v.addModal= false;
      v.editModal=false;
      v.deleteModal=false;
      v.refresh()
    },

    clearAllProyecto_construccion()
    {
      v.newProyecto_construccion = { 
        nombre_proyecto:'',
      	fecha_inicio:'',
      	fecha_fin:'',
      	estado_proyecto:''
      };    
      v.formValidate = false;
      v.addModal= false;
      v.editModal=false;
      v.deleteModal=false;
      v.refresh()
    },

    //METODOS: noResult
    noResult()
    {
      v.emptyResult = true;  // become true if the record is empty, print 'No Record Found'
      v.users = null 
      v.totalUsers = 0 //remove current page if is empty
    },

    noResultProyecto_construccion()
    {
      v.emptyResult = true;  // become true if the record is empty, print 'No Record Found'
      v.items_proyecto_construccion = null 
      v.totalItems_proyecto_construccion = 0 //remove current page if is empty
    },

    //METODOS AUXILIARES: tbl_persona
    pickGender(gender)
    {
      return v.newUser.gender = gender //add new user with selecting gender
    },
    changeGender(gender)
    {
      return v.chooseUser.gender = gender //update gender
    },
    imgGender(value)
    {
      return v.url+'assets/img/gender_'+value+'.png' //for image gender sign in the table
    },

    //METODOS AUXILIARES: tbl_proyecto_construccion
    pickEstado(estado)
    {
      return v.newProyecto_construccion.Estado = estado //Agregar nuevo proyecto de construccion con la selección de estado
    },
    changeEstado(estado)
    {
      return v.chooseProyecto_construccion.Estado = estado //actualizar Estado
    },

    //METODOS: pageUpdate
    pageUpdate(pageNumber)
    {
      v.currentPage = pageNumber; //receive currentPage number came from pagination template
      v.refresh()  
    },

    pageUpdateProyecto_construccion(pageNumber)
    {
      v.currentPage = pageNumber; //receive currentPage number came from pagination template
      v.refreshProyecto_construccion()  
    },

    //METODOS: refresh
    refresh()
    {
      v.search.text ? v.searchUser() : v.showAll(); //for preventing
    },

    refreshProyecto_construccion()
    {
      v.search.text ? v.searchProyecto_construccion() : v.mostrar_items_proyecto_construccion(); //for preventing
    }

  }
})