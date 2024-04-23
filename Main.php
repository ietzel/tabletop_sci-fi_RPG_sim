<?php
$servername = "localhost";
$username = "username";
$password = "password";

function damage(stat, target, ranged) {
  accuracystat = getModOfStat(stat);
  dexpenalty = 0;
  crouch_mod = 0;
  cover_mod = 0;
  if(this.crouching == -1) {
    crouch_mod = 4;
  } else if(this.crouching == -2) {
    cover_mod = 2;
  }
  if((this.sped+this.ment)>=(this.ofns*2)) {
    if((this.ment>target.ment) && (this.sped>target.ment)) {
      dexpenalty = target.sped;
    }
  } else {
    if(this.ofns>target.ment) {
      dexpenalty = target.sped;
    }
  }
  if(!ranged) {
    if(getDist(this.x, this.y, this.z, target.x, target.y, target.z) <= size*1.5) {
      if((accuracystat-crouch_mod) >= (getModOfStat(target.sped)-dexpenalty)) {
        if((accuracystat-crouch_mod+10) >= (getModOfStat(target.sped)-dexpenalty)) {
          if((accuracystat*2) >= getModOfStat(target.dfse)) {
            characters = splice([indexOf(target), 1]
          }
        } else {
          if(getDist(this.x, this.y, this.z, target.x, target.y, target.z) <= size*6) {
            if((accuracystat-cover_mod) >= (getModOfStat(target.sped)-dexpenalty)) {
              if(accuracystat >= getModOfStat(target.dfse)) {
                characters = splice([indexOf(target), 1]
              }
            }
          }
        }
      }
    }
  }
}

function update() {
  this.x += this.dX;
  this.y += this.dY;
  this.z += this.dZ;
  translate(this.x, this.y, this.z);
  this.solid = box(size/2, size/2, size*1.5); /
}       
function getModOfStat(stat) {
  return Math.floor((stat-10)/2);
}
function getDist(x, y, z, xb, yb, zb) {
  return Math.sqrt(((x-xb)^2)+((y-yb)^2)+((z-zb)^2))
}

try {
  $conn = new PDO("mysql:host=$servername;dbname=game", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>
