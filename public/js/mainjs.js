function CheckInternetConnection() {
    alert();
    
                    if (navigator.onLine) {
                        this.ConnectionStatus = "Connected to internet.";
                        StopLoading();
                    }
                    else {
                        this.ConnectionStatus = "Unable to connect to internet.";
                        StartLoading();
                    }

}

function StartLoading() {
    
                if (navigator.onLine) {
                    this.ConnectionStatus = "Connected to internet.";
                }
                else {
                    this.ConnectionStatus = "Unable to connect to internet.";
                }
                $('#LoadingModal').modal('show');
                $("#ContentSection").addClass("DisabledSection");
           
        }

        function  StopLoading() {
                    $('#LoadingModal').modal('hide');
                    $("#ContentSection").removeClass("DisabledSection");
            
                }

// export default {
//     mounted() {
        
//      this.CheckInternetConnection();
       
//     },

//     return: {
//         ConnectionStatus:'',
//     },
//     methods: {
//         CheckInternetConnection() {
//             alert();
//                 if (navigator.onLine) {
//                     this.ConnectionStatus = "Connected to internet.";
//                     this.StopLoading();
//                 }
//                 else {
//                     this.ConnectionStatus = "Unable to connect to internet.";
//                     this.StartLoading();
//                 }
           
//         },
//         StartLoading() {
    
//             if (navigator.onLine) {
//                 this.ConnectionStatus = "Connected to internet.";
//             }
//             else {
//                 this.ConnectionStatus = "Unable to connect to internet.";
//             }
//             $('#LoadingModal').modal('show');
//             $("#ContentSection").addClass("DisabledSection");
       
//     },
//     StopLoading() {
            
//         $('#LoadingModal').modal('hide');
//         $("#ContentSection").removeClass("DisabledSection");

//     },

        
//     }
// }


