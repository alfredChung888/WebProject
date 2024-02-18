/*20463494 Alfred Chung*/


function validateForm() {
          var valid = false;
          var checkedDropDown = false;
          var validYear = false;

          if (checkDropDown() == false) {

                    checkedDropDown = false;

          }
          else {

                    checkedDropDown = true;

          }

          if (checkValidYear() == false) {

                    validYear = false;

          }
          else {

                    validYear = true;
          }

          if (checkedDropDown == true && validYear == true) {
                    return true;
          }
          else {
                    return false;
          }
}


function checkDropDown() {
          var pick = document.getElementById("employeeIds");
          if (pick.value != " ") {
                    document.getElementById("employeeIds").labels[0].style.color = "black";
                    document.getElementById("invalidPick").style.display = "none";
                    return true;
          }
          else
                    document.getElementById("employeeIds").labels[0].style.color = "red";
          document.getElementById("invalidPick").style.display = "inline-block";
          return false;
}

function checkValidYear() {
          var regExpression = /^[0-9]{4}$/;
          var enteredDate = document.getElementById("year").value;
          var expression = false;

          if (regExpression.test(enteredDate)) {
                    expression = true;
          }
          else {
                    expression = false;
          }

          if (expression == true) {
                    enteredDate = parseInt(enteredDate);
                    if (enteredDate >= 2022 && enteredDate <= 2030) {
                              document.getElementById("year").labels[0].style.color = "black";
                              document.getElementById("invalidYear").style.display = "none";
                              return true;
                    }
                    else {
                              document.getElementById("year").labels[0].style.color = "red";
                              document.getElementById("invalidYear").style.display = "inline-block";
                              return false;
                    }
          }
          else {
                    document.getElementById("year").labels[0].style.color = "red";
                    document.getElementById("invalidYear").style.display = "inline-block";
                    return false;

          }
}

function validateForm2() {
          var jobKnowledgeCheck = false;
          var workQualityCheck = false;
          var initiativeCheck = false;
          var communicationCheck = false;
          var dependabilityCheck = false;
          var additionalCommentsCheck = false;



          if (checkNumbersKnow()) {
                    jobKnowledgeCheck = true;
          }
          else {
                    jobKnowledgeCheck = false;
          }
          if (checkNumbersWorkQ()) {
                    workQualityCheck = true;
          }
          else {
                    workQualityCheck = false;
          }
          if (checkNumbersIniti()) {
                    initiativeCheck = true;
          }
          else {
                    initiativeCheck = false;
          }
          if (checkNumbersCom()) {
                    communicationCheck = true;
          }
          else {
                    communicationCheck = false;
          }
          if (checkNumbersDepend()) {
                    dependabilityCheck = true;
          }
          else {
                    dependabilityCheck = false;
          }

          if (checkAdditionalComments()) {
                    additionalCommentsCheck = true;
          }
          else {
                    additionalCommentsCheck = false;
          }

          if (jobKnowledgeCheck == true && workQualityCheck == true && initiativeCheck == true &&
                    communicationCheck == true && dependabilityCheck == true && 
additionalCommentsCheck == true) {
                    return true;
          }
          else {
                    return false;
          }


}


function checkNumbersKnow() {
          var inputValue = document.getElementById("jobKnowledge").value;
          var inputValueLength = inputValue.toString().length;

          if(isNaN(inputValue)==true){
                    document.getElementById("JobKnow").style.color = "red";
                    document.getElementById("notAnumberknow").style.display = "inline-block";
                    
                    return false;
          }
          else if (inputValue > 5 || isNaN(inputValue)) {
                    document.getElementById("JobKnow").style.color = "red";
                    document.getElementById("tooLargeknow").style.display = "inline-block";
                    document.getElementById("notAnumberknow").style.display = "none";
                    document.getElementById("tooSmallknow").style.display = "none";

                    return false;
          }

          else if ((inputValue < 1 && inputValueLength > 0) || isNaN(inputValue)) {
                    document.getElementById("JobKnow").style.color = "red";
                    document.getElementById("tooSmallknow").style.display = "inline-block";
                    document.getElementById("notAnumberknow").style.display = "none";
                    document.getElementById("tooLargeknow").style.display = "none";

                    return false;
          }

          else {
                    document.getElementById("JobKnow").style.color = "black";
                    document.getElementById("notAnumberknow").style.display = "none";
                    document.getElementById("tooLargeknow").style.display = "none";
                    document.getElementById("tooSmallknow").style.display = "none";
                    return true;
          }
}
function checkNumbersWorkQ() {
          var inputValue = document.getElementById("workQuality").value;
          var inputValueLength = inputValue.toString().length;


          if(isNaN(inputValue)==true){
                    document.getElementById("WorkQua").style.color = "red";
                    document.getElementById("notAnumberWQ").style.display = "inline-block";
                    return false;
          }

          else if (inputValue > 5 || isNaN(inputValue)) {
                    document.getElementById("WorkQua").style.color = "red";
                    document.getElementById("tooLargeWQ").style.display = "inline-block";
                    document.getElementById("notAnumberWQ").style.display = "none";
                    document.getElementById("tooSmallWQ").style.display = "none";

                    return false;
          }

          else if ((inputValue < 1 && inputValueLength > 0) || isNaN(inputValue)) {
                    document.getElementById("WorkQua").style.color = "red";
                    document.getElementById("tooSmallWQ").style.display = "inline-block";
                    document.getElementById("notAnumberWQ").style.display = "none";
                    document.getElementById("tooLargeWQ").style.display = "none";

                    return false;
          }

          else {
                    document.getElementById("notAnumberWQ").style.display = "none";
                    document.getElementById("WorkQua").style.color = "black";
                    document.getElementById("tooLargeWQ").style.display = "none";
                    document.getElementById("tooSmallWQ").style.display = "none";
                    return true;
          }
}
function checkNumbersIniti() {
          var inputValue = document.getElementById("initiative").value;
          var inputValueLength = inputValue.toString().length;

          if(isNaN(inputValue)==true){
                    document.getElementById("Initi").style.color = "red";
                    document.getElementById("notAnumberIni").style.display = "inline-block";
                    return false;
          }

          else if (inputValue > 5 || isNaN(inputValue)) {
                    document.getElementById("Initi").style.color = "red";
                    document.getElementById("tooLargeIni").style.display = "inline-block";
                    document.getElementById("notAnumberIni").style.display = "none";
                    document.getElementById("tooSmallIni").style.display = "none";

                    return false;
          }

          else if ((inputValue < 1 && inputValueLength > 0) || isNaN(inputValue)) {
                    document.getElementById("Initi").style.color = "red";
                    document.getElementById("tooSmallIni").style.display = "inline-block";
                    document.getElementById("notAnumberIni").style.display = "none";
                    document.getElementById("tooLargeIni").style.display = "none";

                    return false;
          }

          else {
                    document.getElementById("Initi").style.color = "black";
                    document.getElementById("notAnumberIni").style.display = "none";
                    document.getElementById("tooLargeIni").style.display = "none";
                    document.getElementById("tooSmallIni").style.display = "none";
                    return true;
          }
}
function checkNumbersCom() {
          var inputValue = document.getElementById("communication").value;
          var inputValueLength = inputValue.toString().length;

          if(isNaN(inputValue)==true){
                    document.getElementById("Communi").style.color = "red";
                    document.getElementById("notAnumberCom").style.display = "inline-block";
                    return false;
          }

          else if (inputValue > 5 || isNaN(inputValue)) {
                    document.getElementById("Communi").style.color = "red";
                    document.getElementById("tooLargeCom").style.display = "inline-block";
                    document.getElementById("notAnumberCom").style.display = "none";
                    document.getElementById("tooSmallCom").style.display = "none";

                    return false;
          }

          else if ((inputValue < 1 && inputValueLength > 0) || isNaN(inputValue)) {
                    document.getElementById("Communi").style.color = "red";
                    document.getElementById("notAnumberCom").style.display = "none";
                    document.getElementById("tooSmallCom").style.display = "inline-block";
                    document.getElementById("tooLargeCom").style.display = "none";

                    return false;
          }

          else {
                    document.getElementById("Communi").style.color = "black";
                    document.getElementById("notAnumberCom").style.display = "none";
                    document.getElementById("tooLargeCom").style.display = "none";
                    document.getElementById("tooSmallCom").style.display = "none";
                    return true;
          }
}
function checkNumbersDepend() {
          var inputValue = document.getElementById("dependability").value;
          var inputValueLength = inputValue.toString().length;

          if(isNaN(inputValue)==true){ 
                    document.getElementById("Depend").style.color = "red";
                    document.getElementById("notAnumberDepend").style.display = "inline-block";
                    return false;
          }

          else if (inputValue > 5 || isNaN(inputValue)) {
                    document.getElementById("Depend").style.color = "red";
                    document.getElementById("tooLargeDepend").style.display = "inline-block";
                    document.getElementById("notAnumberDepend").style.display = "none";
                    document.getElementById("tooSmallDepend").style.display = "none";

                    return false;
          }

          else if ((inputValue < 1 && inputValueLength > 0) || isNaN(inputValue)) { //if empty()
                    document.getElementById("Depend").style.color = "red";
                    document.getElementById("tooSmallDepend").style.display = "inline-block";
                    document.getElementById("notAnumberDepend").style.display = "none";
                    document.getElementById("tooLargeDepend").style.display = "none";

                    return false;
          }

          else {
                    document.getElementById("Depend").style.color = "black";
                    document.getElementById("notAnumberDepend").style.display = "none";
                    document.getElementById("tooLargeDepend").style.display = "none";
                    document.getElementById("tooSmallDepend").style.display = "none";
                    return true;
          }
}




function checkAdditionalComments() {
          var additionalComments = document.getElementById("additionalComments").value;
          var regExpression = /[a-zA-Z0-9 .!?"-]+$/;

          if (regExpression.test(additionalComments)) {
                    document.getElementById("additionalComments").labels[0].style.color = "black";
                    document.getElementById("invalidComment").style.display = "none";
                    return true;
          }
          else if (additionalComments.toString().length==0) {
                    document.getElementById("additionalComments").labels[0].style.color = "black";
                    document.getElementById("invalidComment").style.display = "none";
                    return true;
          }
          else {
                    document.getElementById("additionalComments").labels[0].style.color = "red";
                    document.getElementById("invalidComment").style.display = "inline-block";
                    return false;
          }

}

