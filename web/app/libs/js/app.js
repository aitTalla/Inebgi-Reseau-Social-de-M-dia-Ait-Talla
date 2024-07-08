$( "#imgsPost" ).click(function() {
  $( "#likePost" ).fadeIn(0.3, function() {
    $( "#likePost" ).fadeOut("slow");
  });
});

$("#likePost").fadeOut(0.5);

function getUserForloginControle(usr,loadingBar) 
{
  loadingBar.html('<i class="fa fa-circle-notch fa-spin"></i>');
  rep = "";
  $.get("/app/libs/php/api/user.php?getUserForloginControle=1&usr="+usr).done(function (data) {
    if (data == '') {rep="pleas enter username !"}
    else if(data == '404'){rep="username not founds !"}
    else{rep=data}
  loadingBar.html(rep)
  });
  
  console.log(loadingBar.html());
}


function registerNewUsers(errormsg,btn) {
  btnTemp = btn.html();
  btn.html('<i class="fa fa-circle-notch fa-spin"></i>');
  
  errormsg.html("");
  error = 0;

  usr    = $("input[name|='regusr']")[0].value;
  psw    = $("input[name|='regpsw']")[0].value;
  repsw  = $("input[name|='reregpsw']")[0].value;
  gender = $(".ui.dropdown").dropdown("get value");
  
  if (usr.length <= 4) {errormsg.append("<a class='text-danger'>username mini 6 letter !</a>");error++;}
  if (psw.length <= 4) {errormsg.append("<a class='text-danger'>password mini 6 letter !</a>");error++;}
  if (psw != repsw) {errormsg.append("<a class='text-danger'>password not machings !</a>");error++;}
  if (gender == "") {errormsg.append("<a class='text-danger'>gender is null!</a>");error++;}

  $.get("/app/libs/php/api/user.php?isUserExisted=1&usr="+usr).done(function (data) {
    if(data == 1)
    {
      error= error+1;
      errormsg.append("<a class='text-danger'>username is existed !</a>");
    }else if(data == 0){
      if (error == 0) {
        $.post("/app/libs/php/api/user.php",
          {
            "registerUser":1,
            "usr": usr,
            "psw": psw,
            "gender": gender
          }).done(function (data) {
            if (data == "done") 
            {window.location = "profile.php?usr="+usr;}
        })
        console.log("startings register !")
      }
    }
    btn.html(btnTemp);
    
    console.log(error)
  })
}

function loginIntoWeb(usr,psw,btn) {
  btnTemp = btn.html();
  btn.html('<i class="fa fa-circle-notch fa-spin"></i>');
  $.post("/app/libs/php/api/user.php",
    {
      "userLoginCheks": 1,
      "usr": usr,
      "psw": psw
    }).done(function (data) 
  {
    if(data == 0)
    {
      btn.html("fails");
    }else
    {
      window.location = "/index.php";
    }
  });
    setTimeout(function (){btn.html(btnTemp)},700);

}


function getRandomPosts(panel) {
  //postsPanels
  $.get("/app/libs/php/api/posts.php?getRandomPosts=1").done(function (data) {
    panel.append(data);
  })
}

function getRandomPosts(panel) {
  //postsPanels
  $.get("/app/libs/php/api/posts.php?getRandomPosts=1").done(function (data) {
    panel.append(data);
  })
}

function getMyPosts(usr,panel) {
  //postsPanels
  $.get("/app/libs/php/api/posts.php?getsPostUser=1&usr="+usr).done(function (data) {
    panel.append(data);
  })
}
function getMyLastPost(usr)
{
  $.get("/app/libs/php/api/posts.php?getLastPostUser=1&usr="+usr).done(function (data) {
    panel.html("!");
    getMyPosts(usr,panel)
  })
}


function addPostLittel(author,description,cover,postImages,btn) {
  btnTemp = btn.html();
  btn.html('<i class="fa fa-circle-notch fa-spin"></i>');
  if (postImages.length >= 1)
  {
    cover = postImages[0];
  }else{
    cover = "";
  }
  if (description.value == "" && cover == "") 
  {
    btn.html('<a class="text-warning m-5">FAILS ! TEXT EMPTY !</a>');
    setTimeout(function (){btn.html(btnTemp)},700);
    return 0;
  }
  $.post("/app/libs/php/api/posts.php",
    {
      "addPost": 1,
      "author": author,
      "description": description.value,
      "cover": cover
    }).done(function (data) 
  {
    if(data == "done")
    {
      description.value = "";
      setTimeout(getMyLastPost(author),1000);
    }else
    {
      btn.html("fails");
    }
  });
  setTimeout(function (){btn.html(btnTemp)},700);
}



function deletePost(id,btn) {
  btnTemp = btn.html();
  btn.html('<i class="fa fa-circle-notch fa-spin"></i>');
  $.post("/app/libs/php/api/posts.php",
    {
      "deletePost": 1,
      "id": id
    }).done(function (data) 
  {
    if(data == "done")
    {
      $("#post"+id).fadeOut("slow");
    }else
    {
      btn.html("fails");
    }
  });
  setTimeout(function (){btn.html(btnTemp)},700);
}

function updateUserAvatar(usr,img) 
{ 
  $.post("/app/libs/php/api/user.php",
    {
      "updateAvatar": 1,
      "usr": usr,
      "img": img
    }).done(function (data) 
    {
    if(data != "done")
    {
      alert("fail Update Image !");
    }
  });
  
  return true;

}
function updateCover(usr,img) 
{ 
  $.post("/app/libs/php/api/user.php",
    {
      "updateCover": 1,
      "usr": usr,
      "img": img
    }).done(function (data) 
    {
    if(data != "done")
    {
      alert("fail Update Image !");
    }
  });
  
  return true;

}
function likePostByID(id,div) {
    if (div.children().hasClass("red"))
    {
      $.post("/app/libs/php/api/posts.php",
      {
        "dislikePostByID": 1,
        "id": id
      }).done(function (data) 
      {
      if(data == "done")
      {
        div.children()[1].innerHTML = parseInt(div.children()[1].innerHTML) - 1;
        div.children().removeClass("red");
      }else{
        alert("fail Liking This Post !");
      }
      });
    }else{
      $.post("/app/libs/php/api/posts.php",
      {
        "likePostByID": 1,
        "id": id
      }).done(function (data) 
      {
      if(data == "done")
      {
        div.children()[1].innerHTML = parseInt(div.children()[1].innerHTML) + 1;
        div.children().addClass("red");
      }else{
        alert("fail Liking This Post !");
      }
      });
    }
  
  return true;
}
