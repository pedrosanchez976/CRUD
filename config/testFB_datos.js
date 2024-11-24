
  //https://psh.sytes.net/crud/config/conexionFB.php?query=SELECT * FROM HOSPITALES WHERE idhospital in (3,5,6)&db=serviciowebtv.sytes.net/3050:c:/tv/hospitales.fdb
  var url="https://psh.sytes.net/crud/config/conexionFB.php";

  var dbuser="";
  var dbpassword="";
  var dbUrl="serviciowebtv.sytes.net/3050:c:/tv/hospitales.fdb";
  //var query="SELECT * FROM HOSPITALES WHERE idhospital in (3,5,6,7,8)";
  var query="SELECT IDHOSPITAL,HOSPITAL,IP,RUTADB,fehoInstalacion,nHabitaciones nHabs FROM HOSPITALES WHERE idhospital in (2,3,5,6,7,8,9,10,11,12,13,14,15,16,17,18)";
  //var query="SELECT a.PROD_ID, a.PROD_NOM, a.EST, a.FECH_CREA, a.FECH_MODI, a.FECH_ELIM FROM TM_PRODUCTO a";
 // , a.NHABITACIONES, a.NHABITACIONESACTIVAS,

  var columns= [
    { title: 'Name' },
    { title: 'Position' },
    { title: 'Office' },
    { title: 'Extn.' },
    { title: 'Start date' },
    { title: 'Salary' }
];

var buttons= [
  'colvis',
  'excel',
  'print'
]


var aaa={
    "nCampos":6,
    "campos":["PROD_ID","PROD_NOM","EST","FECH_CREA","FECH_MODI","FECH_ELIM"],
    "tipos":["INTEGER:4","VARCHAR:100","INTEGER:4","TIMESTAMP:8","TIMESTAMP:8","TIMESTAMP:8"],
    "alias":["PROD_ID","PROD_NOM","EST","FECH_CREA","FECH_MODI","FECH_ELIM"],
    "relation":["TM_PRODUCTO","TM_PRODUCTO","TM_PRODUCTO","TM_PRODUCTO","TM_PRODUCTO","TM_PRODUCTO"],
    "datos":[
        [1,"producto1",1,"2024-11-13 12:19:34","2024-11-13 19:13:21",null],
        [2,"producto2",1,"2024-11-13 23:04:41","asdffadf","hola null"],
        [1,"producto1",1,"2024-11-13 12:19:34","2024-11-13 19:13:21",null],
        [2,"producto2",1,"2024-11-13 23:04:41","asdffadf","hola null"],
        [1,"producto1",1,"2024-11-13 12:19:34","2024-11-13 19:13:21",null],
        [2,"producto2",1,"2024-11-13 23:04:41","asdffadf","hola null"],
        [1,"producto1",1,"2024-11-13 12:19:34","2024-11-13 19:13:21",null],
        [2,"producto2",1,"2024-11-13 23:04:41","asdffadf","hola null"],
        [1,"producto1",1,"2024-11-13 12:19:34","2024-11-13 19:13:21",null],
        [2,"producto2",1,"2024-11-13 23:04:41","asdffadf","hola null"],
        [1,"producto1",1,"2024-11-13 12:19:34","2024-11-13 19:13:21",null],
        [2,"producto2",1,"2024-11-13 23:04:41","asdffadf","hola null"],
        [1,"producto1",1,"2024-11-13 12:19:34","2024-11-13 19:13:21",null],
        [2,"producto2",1,"2024-11-13 23:04:41","asdffadf","hola null"],
    ]
};
