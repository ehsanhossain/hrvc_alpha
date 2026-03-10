var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == "localhost") {
     $baseUrl = window.location.protocol + "//" + window.location.host + "/HRVC/frontend/web/";
} else {
     $baseUrl = window.location.protocol + "//" + window.location.host + "/";
}
$url = $baseUrl;

function toggleGroupMenuI(groupname) {
     let showIcon = $("#" + groupname + "-show");
     let hideIcon = $("#" + groupname + "-hide");

     if (showIcon.is(":visible")) {
          showGroupMenu(groupname);
     } else {
          hideGroupMenu(groupname);
     }
}

function hideGroupMenu(groupname) {
     //$("#" + groupname).hide();
     $("#" + groupname).slideUp(200);
     $("#" + groupname + "-hide").hide();
     $("#" + groupname + "-show").show();
     var url = $url + "site/session-menu";
     $.ajax({
          type: "POST",
          dataType: "json",
          url: url,
          data: { groupname: groupname, type: "hide" },
          success: function (data) { },
     });
}
function showGroupMenu(groupname) {
     $("#" + groupname).slideDown(200);
     $("#" + groupname + "-show").hide();
     $("#" + groupname + "-hide").show();
     var url = $url + "site/session-menu";
     $.ajax({
          type: "POST",
          dataType: "json",
          url: url,
          data: { groupname: groupname, type: "show" },
          success: function (data) { },
     });
}

$(document).mouseup(function (e) {
     var profile = $("#profileMenu");
     var profileDropdown = profile.closest('.profile-dropdown');
     if (!profile.is(e.target) && profile.has(e.target).length === 0 && !profileDropdown.is(e.target) && profileDropdown.has(e.target).length === 0) {
          profile.hide();
     }
     var country = $("#countryMenu");
     var langDropdown = country.closest('.language-dropdown');
     if (!country.is(e.target) && country.has(e.target).length === 0 && !langDropdown.is(e.target) && langDropdown.has(e.target).length === 0) {
          country.hide();
     }
});
