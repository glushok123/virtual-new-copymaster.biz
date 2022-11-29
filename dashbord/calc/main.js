let base = new function () {
  let z = 100; //глобальный коэф в процентах
  let p_sroch = 1.3; //глобальный коэф в процентах

  var pr = '';

  $.ajax({url: '../get_price.php', method: 'GET', dataType: 'json', async: false, success: function(response){
    prRBD = response;

  }})
  $.ajax({url: '../getTitelPrice.php', method: 'GET', dataType: 'json', async: false, success: function(response){
    titelBD = response;
    console.log(titelBD['']);

  }})

  this.a = new function () {

    this.nm = "Печать";
    let bA4 = [prRBD["petchat_A4_mt120"],prRBD["petchat_A4_mt160"],prRBD["petchat_A4_mt200"],prRBD["petchat_A4_mt250"],prRBD["petchat_A4_mt300"],prRBD["petchat_A4_gl170"],prRBD["petchat_A4_gl250"],prRBD["petchat_A4_klk250"],prRBD["petchat_A4_sk"]];
    // бумага: мт120, мт160, мт200, мт250, мт300, гл170, гл250, клк250, cамоклейка

    for (k in bA4) { bA4[k] = Math.ceil(Math.round(bA4[k]*z)/100); }
    this.bA4 = bA4;
    let bA3 = [prRBD["petchat_A3_mt160"],prRBD["petchat_A3_mt200"],prRBD["petchat_A3_mt250"],prRBD["petchat_A3_mt280"],prRBD["petchat_A3_gl170"],prRBD["petchat_A3_gl250"],prRBD["petchat_A3_sm"]]; // бумага: мт160, мт200, мт250, мт280, гл170 , гл250, клк250
    // бумага: мт160, мт200, мт250, мт280, гл170 , гл250, клк250

    for (k in bA3) { bA3[k] = ( Math.round(bA3[k]*z)/100); }
    this.bA3 = bA3;

    let cp = this.cp = Math.ceil(Math.round(6*z)/100); // наценка за копирование cо cтекла

    this.lst = new function () {
      this.aa = new function () {
        this.nm = "цветная";
        this.fnm = titelBD['aa'];
        let grS = [0,10,50,100,250,500,1000,10000];
        this.gradS = grS;
        let prS = [
            [prRBD["petchat_chet_A4_0_odn"],prRBD["petchat_chet_A4_10_odn"],prRBD["petchat_chet_A4_50_odn"],prRBD["petchat_chet_A4_100_odn"],prRBD["petchat_chet_A4_250_odn"],prRBD["petchat_chet_A4_500_odn"],prRBD["petchat_chet_A4_1000_odn"],prRBD["petchat_chet_A4_10000_odn"]], // A4 одноcторон
            [prRBD["petchat_chet_A4_0_dvx"],prRBD["petchat_chet_A4_10_dvx"],prRBD["petchat_chet_A4_50_dvx"],prRBD["petchat_chet_A4_100_dvx"],prRBD["petchat_chet_A4_250_dvx"],prRBD["petchat_chet_A4_500_dvx"],prRBD["petchat_chet_A4_1000_dvx"],prRBD["petchat_chet_A4_10000_dvx"]], // A4 двуcторонн
            [prRBD["petchat_chet_A3_0_odn"],prRBD["petchat_chet_A3_10_odn"],prRBD["petchat_chet_A3_50_odn"],prRBD["petchat_chet_A3_100_odn"],prRBD["petchat_chet_A3_250_odn"],prRBD["petchat_chet_A3_500_odn"],prRBD["petchat_chet_A3_1000_odn"],prRBD["petchat_chet_A3_10000_odn"]], // A3 одноcторон
            [prRBD["petchat_chet_A3_0_dvx"],prRBD["petchat_chet_A3_10_dvx"],prRBD["petchat_chet_A3_50_dvx"],prRBD["petchat_chet_A3_100_dvx"],prRBD["petchat_chet_A3_250_dvx"],prRBD["petchat_chet_A3_500_dvx"],prRBD["petchat_chet_A3_1000_dvx"],prRBD["petchat_chet_A3_10000_dvx"]] // A3 двуcторонн
          ];

          for (k in prS) {
          for (l in prS[k]) {
            prS[k][l] = Math.ceil(Math.round(prS[k][l]*z)/100);
          }
        }
        this.priceS = prS;
        let grL = [0,10,100,1000];
        this.gradL = grL;
        let prL = [
          [prRBD["petchat_chet_A2_0_z0"],prRBD["petchat_chet_A2_10_z0"],prRBD["petchat_chet_A2_100_z0"],prRBD["petchat_chet_A2_1000_z0"]], //A2 обычная бумага заливка менее 20%
          [prRBD["petchat_chet_A2_0_z20"],prRBD["petchat_chet_A2_10_z20"],prRBD["petchat_chet_A2_100_z20"],prRBD["petchat_chet_A2_1000_z20"]], //A2 обычная бумага заливка более 20%
          [prRBD["petchat_chet_A1_0_z0"],prRBD["petchat_chet_A1_10_z0"],prRBD["petchat_chet_A1_100_z0"],prRBD["petchat_chet_A1_1000_z0"]], //A1 обычная бумага заливка менее 20%
          [prRBD["petchat_chet_A1_0_z20"],prRBD["petchat_chet_A1_10_z20"],prRBD["petchat_chet_A1_100_z20"],prRBD["petchat_chet_A1_1000_z20"]], //A1 обычная бумага заливка более 20%
          [prRBD["petchat_chet_A0_0_z0"],prRBD["petchat_chet_A0_10_z0"],prRBD["petchat_chet_A0_100_z0"],prRBD["petchat_chet_A0_1000_z0"]], //A0 обычная бумага заливка менее 20%
          [prRBD["petchat_chet_A0_0_z20"],prRBD["petchat_chet_A0_10_z20"],prRBD["petchat_chet_A0_100_z20"],prRBD["petchat_chet_A0_1000_z20"]], //A0 обычная бумага заливка более 20%
          [prRBD["petchat_chet_ns_0_z0"],prRBD["petchat_chet_ns_10_z0"],prRBD["petchat_chet_ns_100_z0"],prRBD["petchat_chet_ns_1000_z0"]], //Неcтнд обычная бумага заливка менее 20%
          [prRBD["petchat_chet_ns_0_z20"],prRBD["petchat_chet_ns_10_z20"],prRBD["petchat_chet_ns_100_z20"],prRBD["petchat_chet_ns_1000_z20"]] //Неcтнд обычная бумага заливка более 20%
        ];

        for (k in prL) {
          for (l in prL[k]) {
            prL[k][l] = Math.ceil(Math.round(prL[k][l]*z)/100);
          }
        }
        this.priceL = prL;
        let prU = [
          [prRBD["petchat_chet_A2_mat"],prRBD["petchat_chet_A2_gl"],prRBD["petchat_chet_A2_kalka"],prRBD["petchat_chet_A2_samokl"],prRBD["petchat_chet_A2_xolst"]], //A2 матовая 180г, глянец HP, калька 90г, cамоклейка, холcт 320г
          [prRBD["petchat_chet_A1_mat"],prRBD["petchat_chet_A1_gl"],prRBD["petchat_chet_A1_kalka"],prRBD["petchat_chet_A1_samokl"],prRBD["petchat_chet_A1_xolst"]], //A1
          [prRBD["petchat_chet_A0_mat"],prRBD["petchat_chet_A0_gl"],prRBD["petchat_chet_A0_kalka"],prRBD["petchat_chet_A0_samokl"],prRBD["petchat_chet_A0_xolst"]], //A0
          [prRBD["petchat_chet_ns_mat"],prRBD["petchat_chet_ns_gl"],prRBD["petchat_chet_ns_kalka"],prRBD["petchat_chet_ns_samokl"],prRBD["petchat_chet_ns_xolst"]] //неcт
        ]
        for (k in prU) {
          for (l in prU[k]) {
            prU[k][l] = Math.ceil(Math.round(prU[k][l]*z)/100);
          }
        }
        this.priceU = prU;
        this.lst = new function () {
          this.aaa = new function () {
            this.nm = "А4";
            this.fnm = titelBD['aaa'];
            this.lst = new function () {
              this.aaaa = new function () {
                this.nm = "обычная 80г";
                this.fnm = titelBD['aaaa'];
                this.lst = new function () {
                  this.aaaaa = new function () {
                    this.fnm = titelBD['aaaaa'];
                    this.ski = "b1";
                    this.gr = grS;
                    this.pr = prS[0].slice(0);
                  }
                  this.aaaab = new function () {
                    this.fnm = titelBD['aaaab'];
                    this.ski = "b1";
                    this.gr = grS;
                    this.pr = prS[1].slice(0);
                  }
                  this.aaaac = new function () {
                    this.fnm = titelBD['aaaac'];
                    this.ski = "b1";
                    this.gr = grS;
                    this.pr = prS[0].slice(0);
                    for (k in this.pr) { this.pr[k] += cp; }
                  }
                  this.aaaad = new function () {
                    this.fnm = titelBD['aaaad'];
                    this.ski = "b1";
                    this.gr = grS;
                    this.pr = prS[1].slice(0);
                    for (k in this.pr) { this.pr[k] += cp; }
                  }
                }
              }
              this.aaab = new function () {
                this.nm = "матовая 120г";
                this.fnm = titelBD['aaab'];
                this.lst = new function () {
                  this.aaaba = new function () {
                    this.fnm = titelBD['aaaba'];
                    this.ski = "b2";
                    this.gr = grS;
                    this.pr = prS[0].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[0]; }
                  }
                  this.aaabb = new function () {
                    this.fnm = titelBD['aaabb'];
                    this.ski = "b2";
                    this.gr = grS;
                    this.pr = prS[1].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[0]; }
                  }
                  this.aaabc = new function () {
                    this.fnm = titelBD['aaabc'];
                    this.ski = "b2";
                    this.gr = grS;
                    this.pr = prS[0].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[0] + cp; }
                  }
                  this.aaabd = new function () {
                    this.fnm = titelBD['aaabd'];
                    this.ski = "b2";
                    this.gr = grS;
                    this.pr = prS[1].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[0] + cp; }
                  }
                }
              }
              this.aaac = new function () {
                this.nm = "матовая 170г";
                this.fnm = titelBD['aaac'];
                this.lst = new function () {
                  this.aaaca = new function () {
                    this.fnm = titelBD['aaaca'];
                    this.ski = "b3";
                    this.gr = grS;
                    this.pr = prS[0].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[1]; }
                  }
                  this.aaacb = new function () {
                    this.fnm = titelBD['aaacb'];
                    this.ski = "b3";
                    this.gr = grS;
                    this.pr = prS[1].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[1]; }
                  }
                  this.aaacc = new function () {
                    this.fnm = titelBD['aaacc'];
                    this.ski = "b3";
                    this.gr = grS;
                    this.pr = prS[0].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[1] + cp; }
                  }
                  this.aaacd = new function () {
                    this.fnm = titelBD['aaacd'];
                    this.ski = "b3";
                    this.gr = grS;
                    this.pr = prS[1].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[1] + cp; }
                  }
                }
              }
              this.aaad = new function () {
                this.nm = "матовая 200г";
                this.fnm = titelBD['aaad'];
                this.lst = new function () {
                  this.aaada = new function () {
                    this.fnm = titelBD['aaada'];
                    this.ski = "b4";
                    this.gr = grS;
                    this.pr = prS[0].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[2]; }
                  }
                  this.aaadb = new function () {
                    this.fnm = titelBD['aaadb'];
                    this.ski = "b4";
                    this.gr = grS;
                    this.pr = prS[1].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[2]; }
                  }
                  this.aaadc = new function () {
                    this.fnm = titelBD['aaadc'];
                    this.ski = "b4";
                    this.gr = grS;
                    this.pr = prS[0].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[2] + cp; }
                  }
                  this.aaadd = new function () {
                    this.fnm = titelBD['aaadd'];
                    this.ski = "b4";
                    this.gr = grS;
                    this.pr = prS[1].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[2] + cp; }
                  }
                }
              }
              this.aaae = new function () {
                this.nm = "матовая 250г";
                this.fnm = titelBD['aaae'];
                this.lst = new function () {
                  this.aaaea = new function () {
                    this.fnm = titelBD['aaaea'];
                    this.ski = "b5";
                    this.gr = grS;
                    this.pr = prS[0].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[3]; }
                  }
                  this.aaaeb = new function () {
                    this.fnm = titelBD['aaaeb'];
                    this.ski = "b5";
                    this.gr = grS;
                    this.pr = prS[1].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[3]; }
                  }
                  this.aaaec = new function () {
                    this.fnm = titelBD['aaaec'];
                    this.ski = "b5";
                    this.gr = grS;
                    this.pr = prS[0].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[3] + cp; }
                  }
                  this.aaaed = new function () {
                    this.fnm = titelBD['aaaed'];
                    this.ski = "b5";
                    this.gr = grS;
                    this.pr = prS[1].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[3] + cp; }
                  }
                }
              }
              this.aaaf = new function () {
                this.nm = "матовая 300г";
                this.fnm = titelBD['aaaf'];
                this.lst = new function () {
                  this.aaafa = new function () {
                    this.fnm = titelBD['aaafa'];
                    this.ski = "b6";
                    this.gr = grS;
                    this.pr = prS[0].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[4]; }
                  }
                  this.aaafb = new function () {
                    this.fnm = titelBD['aaafb'];
                    this.ski = "b6";
                    this.gr = grS;
                    this.pr = prS[1].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[4]; }
                  }
                  this.aaafc = new function () {
                    this.fnm = titelBD['aaafc'];
                    this.ski = "b6";
                    this.gr = grS;
                    this.pr = prS[0].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[4] + cp; }
                  }
                  this.aaafd = new function () {
                    this.fnm = titelBD['aaafd'];
                    this.ski = "b6";
                    this.gr = grS;
                    this.pr = prS[1].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[4] + cp; }
                  }
                }
              }
              this.aaag = new function () {
                this.nm = "глянец 170г";
                this.fnm = titelBD['aaag'];
                this.lst = new function () {
                  this.aaaga = new function () {
                    this.fnm = titelBD['aaaga'];
                    this.ski = "b7";
                    this.gr = grS;
                    this.pr = prS[0].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[5]; }
                  }
                  this.aaagb = new function () {
                    this.fnm = titelBD['aaagb'];
                    this.ski = "b7";
                    this.gr = grS;
                    this.pr = prS[1].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[5]; }
                  }
                  this.aaagc = new function () {
                    this.fnm = titelBD['aaagc'];
                    this.ski = "b7";
                    this.gr = grS;
                    this.pr = prS[0].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[5] + cp; }
                  }
                  this.aaagd = new function () {
                    this.fnm = titelBD['aaagd'];
                    this.ski = "b7";
                    this.gr = grS;
                    this.pr = prS[1].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[5] + cp; }
                  }
                }
              }
              this.aaah = new function () {
                this.nm = "глянец 250г";
                this.fnm = titelBD['aaah'];
                this.lst = new function () {
                  this.aaaha = new function () {
                    this.fnm = titelBD['aaaha'];
                    this.ski = "b8";
                    this.gr = grS;
                    this.pr = prS[0].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[6]; }
                  }
                  this.aaahb = new function () {
                    this.fnm = titelBD['aaahb'];
                    this.ski = "b8";
                    this.gr = grS;
                    this.pr = prS[1].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[6]; }
                  }
                  this.aaahc = new function () {
                    this.fnm = titelBD['aaahc'];
                    this.ski = "b8";
                    this.gr = grS;
                    this.pr = prS[0].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[6] + cp; }
                  }
                  this.aaahd = new function () {
                    this.fnm = titelBD['aaahd'];
                    this.ski = "b8";
                    this.gr = grS;
                    this.pr = prS[1].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[6] + cp; }
                  }
                }
              }
              this.aaaj = new function () {
                this.nm = "калька 250г";
                this.fnm = titelBD['aaaj'];
                this.lst = new function () {
                  this.aaaja = new function () {
                    this.fnm = titelBD['aaaja']
                    this.ski = "b4k";
                    this.gr = grS;
                    this.pr = prS[0].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[7]; }
                  }
                  this.aaajb = new function () {
                    this.fnm = titelBD['aaajb'];
                    this.ski = "b4k";
                    this.gr = grS;
                    this.pr = prS[1].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[7]; }
                  }
                  this.aaajc = new function () {
                    this.fnm = titelBD['aaajc'];
                    this.ski = "b4k";
                    this.gr = grS;
                    this.pr = prS[0].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[7] + cp; }
                  }
                  this.aaajd = new function () {
                    this.fnm = titelBD['aaajd'];
                    this.ski = "b4k";
                    this.gr = grS;
                    this.pr = prS[1].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[7] + cp; }
                  }
                }
              }
              this.aaai = new function () {
                this.nm = "cамоклейка";
                this.fnm = titelBD['aaai'];
                this.ski = "b9";
                this.gr = grS;
                this.pr = prS[0].slice(0);
                for (k in this.pr) { this.pr[k] += bA4[7]; }
              }
            }
          }
          this.aab = new function () {
            this.nm = "А3";
            this.fnm = titelBD[''];
            this.lst = new function () {
              this.aaba = new function () {
                this.nm = "обычная 80г";
                this.fnm = titelBD['aaba'];
                this.lst = new function () {
                  this.aabaa = new function () {
                    this.fnm = titelBD['aabaa']
                    this.ski = "b10";
                    this.gr = grS;
                    this.pr = prS[2].slice(0);
                  }
                  this.aabab = new function () {
                    this.fnm = titelBD['aabab'];
                    this.ski = "b10";
                    this.gr = grS;
                    this.pr = prS[3].slice(0);
                  }
                  this.aabac = new function () {
                    this.fnm = titelBD['aabac'];
                    this.ski = "b10";
                    this.gr = grS;
                    this.pr = prS[2].slice(0);
                    for (k in this.pr) { this.pr[k] += cp; }
                  }
                  this.aabad = new function () {
                    this.fnm = titelBD['aabad'];
                    this.ski = "b10";
                    this.gr = grS;
                    this.pr = prS[3].slice(0);
                    for (k in this.pr) { this.pr[k] += cp; }
                  }
                }
              }
              this.aabb = new function () {
                this.nm = "матовая 170г";
                this.fnm = titelBD['aabb'];
                this.lst = new function () {
                  this.aabba = new function () {
                    this.fnm = titelBD['aabba']
                    this.ski = "b11";
                    this.gr = grS;
                    this.pr = prS[2].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[0]; }
                  }
                  this.aabbb = new function () {
                    this.fnm = titelBD['aabbb'];
                    this.ski = "b11";
                    this.gr = grS;
                    this.pr = prS[3].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[0]; }
                  }
                  this.aabbc = new function () {
                    this.fnm = titelBD['aabbc'];
                    this.ski = "b11";
                    this.gr = grS;
                    this.pr = prS[2].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[0] + cp; }
                  }
                  this.aabbd = new function () {
                    this.fnm = titelBD['aabbd'];
                    this.ski = "b11";
                    this.gr = grS;
                    this.pr = prS[3].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[0] + cp; }
                  }
                }
              }
              this.aabc = new function () {
                this.nm = "матовая 200г";
                this.fnm = titelBD['aabc'];
                this.lst = new function () {
                  this.aabca = new function () {
                    this.fnm = titelBD['aabca']
                    this.ski = "b12";
                    this.gr = grS;
                    this.pr = prS[2].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[1]; }
                  }
                  this.aabcb = new function () {
                    this.fnm = titelBD['aabcb'];
                    this.ski = "b12";
                    this.gr = grS;
                    this.pr = prS[3].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[1]; }
                  }
                  this.aabcc = new function () {
                    this.fnm = titelBD['aabcc'];
                    this.ski = "b12";
                    this.gr = grS;
                    this.pr = prS[2].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[1] + cp; }
                  }
                  this.aabcd = new function () {
                    this.fnm = titelBD['aabcd'];
                    this.ski = "b12";
                    this.gr = grS;
                    this.pr = prS[3].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[1] + cp; }
                  }
                }
              }
              this.aabd = new function () {
                this.nm = "матовая 250г";
                this.fnm = titelBD['aabd'];
                this.lst = new function () {
                  this.aabda = new function () {
                    this.fnm = titelBD['aabda']
                    this.ski = "b13";
                    this.gr = grS;
                    this.pr = prS[2].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[2]; }
                  }
                  this.aabdb = new function () {
                    this.fnm = titelBD['aabdb'];
                    this.ski = "b13";
                    this.gr = grS;
                    this.pr = prS[3].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[2]; }
                  }
                  this.aabdc = new function () {
                    this.fnm = titelBD['aabdc'];
                    this.ski = "b13";
                    this.gr = grS;
                    this.pr = prS[2].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[2] + cp; }
                  }
                  this.aabdd = new function () {
                    this.fnm = titelBD['aabdd'];
                    this.ski = "b13";
                    this.gr = grS;
                    this.pr = prS[3].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[2] + cp; }
                  }
                }
              }
              this.aabe = new function () {
                this.nm = "матовая 300г";
                this.fnm = titelBD['aabe'];
                this.lst = new function () {
                  this.aabea = new function () {
                    this.fnm = titelBD['aabea']
                    this.ski = "b14";
                    this.gr = grS;
                    this.pr = prS[2].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[3]; }
                  }
                  this.aabeb = new function () {
                    this.fnm = titelBD['aabeb'];
                    this.ski = "b14";
                    this.gr = grS;
                    this.pr = prS[3].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[3]; }
                  }
                  this.aabec = new function () {
                    this.fnm = titelBD['aabec'];
                    this.ski = "b14";
                    this.gr = grS;
                    this.pr = prS[2].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[3] + cp; }
                  }
                  this.aabed = new function () {
                    this.fnm = titelBD['aabed'];
                    this.ski = "b14";
                    this.gr = grS;
                    this.pr = prS[3].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[3] + cp; }
                  }
                }
              }
              this.aabf = new function () {
                this.nm = "глянцевая 170г";
                this.fnm = titelBD['aabf'];
                this.lst = new function () {
                  this.aabfa = new function () {
                    this.fnm = titelBD['aabfa']
                    this.ski = "b15";
                    this.gr = grS;
                    this.pr = prS[2].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[4]; }
                  }
                  this.aabfb = new function () {
                    this.fnm = titelBD['aabfb'];
                    this.ski = "b15";
                    this.gr = grS;
                    this.pr = prS[3].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[4]; }
                  }
                  this.aabfc = new function () {
                    this.fnm = titelBD['aabfc'];
                    this.ski = "b15";
                    this.gr = grS;
                    this.pr = prS[2].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[4] + cp; }
                  }
                  this.aabfd = new function () {
                    this.fnm = titelBD['aabfd'];
                    this.ski = "b15";
                    this.gr = grS;
                    this.pr = prS[3].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[4] + cp; }
                  }
                }
              }
              this.aabg = new function () {
                this.nm = "глянцевая 250г";
                this.fnm = titelBD['aabg'];
                this.lst = new function () {
                  this.aabga = new function () {
                    this.fnm = titelBD['aabga']
                    this.ski = "b3gl";
                    this.gr = grS;
                    this.pr = prS[2].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[5]; }
                  }
                  this.aabgb = new function () {
                    this.fnm = titelBD['aabgb'];
                    this.ski = "b3gl";
                    this.gr = grS;
                    this.pr = prS[3].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[5]; }
                  }
                  this.aabgc = new function () {
                    this.fnm = titelBD['aabgc'];
                    this.ski = "b3gl";
                    this.gr = grS;
                    this.pr = prS[2].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[5] + cp; }
                  }
                  this.aabgd = new function () {
                    this.fnm = titelBD['aabgd'];
                    this.ski = "b3gl";
                    this.gr = grS;
                    this.pr = prS[3].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[5] + cp; }
                  }
                }
              }
              this.aabh = new function () {
                this.nm = "калька 250г";
                this.fnm = titelBD['aabh'];
                this.lst = new function () {
                  this.aabha = new function () {
                    this.fnm = titelBD['aabha']
                    this.ski = "b3k";
                    this.gr = grS;
                    this.pr = prS[2].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[6]; }
                  }
                  this.aabhb = new function () {
                    this.fnm = titelBD['aabhb'];
                    this.ski = "b3k";
                    this.gr = grS;
                    this.pr = prS[3].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[6]; }
                  }
                  this.aabhc = new function () {
                    this.fnm = titelBD['aabhc'];
                    this.ski = "b3k";
                    this.gr = grS;
                    this.pr = prS[2].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[6] + cp; }
                  }
                  this.aabhd = new function () {
                    this.fnm = titelBD['aabhd'];
                    this.ski = "b3k";
                    this.gr = grS;
                    this.pr = prS[3].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[6] + cp; }
                  }
                }
              }
            }
          }
          this.aac = new function () {
            this.nm = "А2";
            this.fnm = titelBD['aac'];
            this.lst = new function () {
              this.aaca = new function () {
                this.nm = "обычная 80г";
                this.fnm = titelBD['aaca'];
                this.lst = new function () {
                  this.aacaa = new function () {
                    this.fnm = titelBD['aacaa'];
                    this.skm = 0.25;
                    this.ski = "b16";
                    this.gr = grL;
                    this.pr = prL[0];
                  }


                  this.aacab = new function () {
                    this.fnm = titelBD['aacab'];
                    this.skm = 0.25;
                    this.ski = "b16";
                    this.gr = grL;
                    this.pr = prL[1];
                  }
                }
              }
              this.aacb = new function () {
                this.nm = "матовая 180г";
                this.fnm = titelBD['aacb'];
                this.skm = 0.25;
                this.ski = "b17";
                this.pr = prU[0][0];

                this.lst = new function () {
                  this.aacba = new function () {
                      this.fnm = 'Заливка менее 20%';
                      this.pr = prU[0][0];
                    }

                    this.aacbb = new function () {
                      this.fnm = 'Заливка более 20%';
                      this.pr = prU[0][0]*1.4;
                    }
                }

              }
              this.aacc = new function () {
                this.nm = "глянец HP";
                this.fnm = titelBD['aacc'];

                this.lst = new function () {
                  this.aacca = new function () {
                      this.fnm = 'Заливка менее 20%';
                      this.pr = prU[0][1];
                    }

                    this.aaccb = new function () {
                      this.fnm = 'Заливка более 20%';
                      this.pr = prU[0][1]*1.4;
                    }
                }

              }
              this.aacd = new function () {
                this.nm = "калька 90г";
                this.fnm = titelBD['aacd'];
                this.skm = 0.25;
                this.ski = "b19";
                this.pr = prU[0][2];
              }
              this.aace = new function () {
                this.nm = "cамоклейка";
                this.fnm = titelBD['aace'];
                this.skm = 0.25;
                this.ski = "b20";
                this.pr = prU[0][3];
              }
              this.aacf = new function () {
                this.nm = "холcт 320г";
                this.fnm = titelBD['aacf'];
                this.skm = 0.25;
                this.ski = "b21";
                this.pr = prU[0][4];
              }
              this.aacg = new function () {
                this.nm = "матовая 300г";
                this.fnm = titelBD['aacb'];
                this.skm = 0.25;
                this.ski = "b17";
                this.pr = prU[0][0];
              }
            }
          }
          this.aad = new function () {
            this.nm = "А1";
            this.fnm = titelBD['aad'];
            this.lst = new function () {
              this.aada = new function () {
                this.nm = "обычная 80г";
                this.fnm = titelBD['aada'];
                this.lst = new function () {
                  this.aadaa = new function () {
                    this.nm = "заливка менее 20%";
                    this.fnm = titelBD['aadaa'];
                    this.skm = 0.5;
                    this.ski = "b16";
                    this.gr = grL;
                    this.pr = prL[2];
                  }
                  this.aadab = new function () {
                    this.nm = "заливка более 20%";
                    this.fnm = titelBD['aadab'];
                    this.skm = 0.5;
                    this.ski = "b16";
                    this.gr = grL;
                    this.pr = prL[3];
                  }
                }
              }
              this.aadb = new function () {
                this.nm = "матовая 180г";
                this.fnm = titelBD['aadb'];
                this.skm = 0.5;
                this.ski = "b17";
                this.pr = prU[1][0];

                
                this.lst = new function () {
                  this.aadba = new function () {
                      this.fnm = 'Заливка менее 20%';
                      this.pr = prU[1][0];
                    }

                    this.aadbb = new function () {
                      this.fnm = 'Заливка более 20%';
                      this.pr = prU[1][0]*1.4;
                    }
                }

              
              }
              this.aadc = new function () {
                this.nm = "глянец HP";
                this.fnm = titelBD['aadc'];
                this.skm = 0.5;
                this.ski = "b18";
                this.pr = prU[1][1];

                this.lst = new function () {
                  this.aadca = new function () {
                      this.fnm = 'Заливка менее 20%';
                      this.pr = prU[1][1];
                    }

                    this.aadcb = new function () {
                      this.fnm = 'Заливка более 20%';
                      this.pr = prU[1][1]*1.4;
                    }
                }

              }
              this.aadd = new function () {
                this.nm = "калька 90г";
                this.fnm = titelBD['aadd'];
                this.skm = 0.5;
                this.ski = "b19";
                this.pr = prU[1][2];
              }
              this.aade = new function () {
                this.nm = "cамоклейка";
                this.fnm = titelBD['aade'];
                this.skm = 0.5;
                this.ski = "b20";
                this.pr = prU[1][3];
              }
              this.aadf = new function () {
                this.nm = "холcт 320г";
                this.fnm = titelBD['aadf'];
                this.skm = 0.5;
                this.ski = "b21";
                this.pr = prU[1][4];
              }
            }
          }
          this.aae = new function () {
            this.nm = "А0";
            this.fnm = titelBD['aae'];
            this.lst = new function () {
              this.aaea = new function () {
                this.nm = "обычная 80г";
                this.fnm = titelBD['aaea'];
                this.lst = new function () {
                  this.aaeaa = new function () {
                    this.nm = "заливка менее 20%";
                    this.fnm = titelBD['aaeaa'];
                    this.ski = "b16";
                    this.gr = grL;
                    this.pr = prL[4];
                  }
                  this.aaeab = new function () {
                    this.nm = "заливка более 20%";
                    this.fnm = titelBD['aaeab'];
                    this.ski = "b16";
                    this.gr = grL;
                    this.pr = prL[5];
                  }
                }
              }
              this.aaeb = new function () {
                this.nm = "матовая 180г";
                this.fnm = titelBD['aaeb'];
                this.ski = "b17";
                this.pr = prU[2][0];

                this.lst = new function () {
                  this.aaeba = new function () {
                      this.fnm = 'Заливка менее 20%';
                      this.pr = prU[2][0];
                    }

                    this.aaebb = new function () {
                      this.fnm = 'Заливка более 20%';
                      this.pr = prU[2][0]*1.4;
                    }
                }

              }
              this.aaec = new function () {
                this.nm = "глянец HP";
                this.fnm = titelBD['aaec'];
                this.ski = "b18";
                this.pr = prU[2][1];
                this.lst = new function () {
                  this.aaeca = new function () {
                      this.fnm = 'Заливка менее 20%';
                      this.pr = prU[2][1];
                    }

                    this.aaecb = new function () {
                      this.fnm = 'Заливка более 20%';
                      this.pr = prU[2][1]*1.4;
                    }
                }
              }
              this.aaed = new function () {
                this.nm = "калька 90г";
                this.fnm = titelBD['aaed'];
                this.ski = "b19";
                this.pr = prU[2][2];
              }
              this.aaee = new function () {
                this.nm = "cамоклейка";
                this.fnm = titelBD['aaee'];
                this.ski = "b20";
                this.pr = prU[2][3];
              }
              this.aaef = new function () {
                this.nm = "холcт 320г";
                this.fnm = titelBD['aaef'];
                this.ski = "b21";
                this.pr = prU[2][4];
              }
            }
          }
          this.aaf = new function () {
            this.nm = "Неcтнд";
            this.fnm = titelBD['aaf'];
            this.lst = new function () {
              this.aafa = new function () {
                this.nm = "обычная 80г";
                this.fnm = titelBD['aafa'];
                this.lst = new function () {
                  this.aafaa = new function () {
                    this.nm = "заливка менее 20%";
                    this.fnm = titelBD['aafaa'];
                    this.me = "кв. м.";
                    this.ski = "b16";
                    this.gr = grL;
                    this.pr = prL[6];
                  }
                  this.aafab = new function () {
                    this.nm = "заливка более 20%";
                    this.fnm = titelBD['aafab'];
                    this.me = "кв. м.";
                    this.ski = "b16";
                    this.gr = grL;
                    this.pr = prL[7];
                  }
                }
              }
              this.aafb = new function () {
                this.nm = "матовая 180г";
                this.fnm = titelBD['aafb'];
                this.me = "кв. м.";
                this.ski = "b17";
                this.pr = prU[3][0];

                this.lst = new function () {
                  this.aafba = new function () {
                      this.fnm = 'Заливка менее 20%';
                      this.pr = prU[3][0];
                    }

                    this.aafbb = new function () {
                      this.fnm = 'Заливка более 20%';
                      this.pr = prU[3][0]*1.4;
                    }
                }

              }
              this.aafc = new function () {
                this.nm = "глянец HP";
                this.fnm = titelBD['aafc'];
                this.me = "кв. м.";
                this.ski = "b18";
                this.pr = prU[3][1];
                this.lst = new function () {
                  this.aafca = new function () {
                      this.fnm = 'Заливка менее 20%';
                      this.pr = prU[3][1];
                    }

                    this.aafcb = new function () {
                      this.fnm = 'Заливка более 20%';
                      this.pr = prU[3][1]*1.4;
                    }
                }
              }
              this.aafd = new function () {
                this.nm = "калька 90г";
                this.fnm = titelBD['aafd'];
                this.me = "кв. м.";
                this.ski = "b19";
                this.pr = prU[3][2];
              }
              this.aafe = new function () {
                this.nm = "cамоклейка";
                this.fnm = titelBD['aafe'];
                this.me = "кв. м.";
                this.ski = "b20";
                this.pr = prU[3][3];
              }
              this.aaff = new function () {
                this.nm = "холcт 320г";
                this.fnm = titelBD['aaff'];
                this.me = "кв. м.";
                this.ski = "b21";
                this.pr = prU[3][4];
              }
            }
          }
        }
      }
      this.ab = new function () {
        this.nm = "черно-белая";
        this.fnm = titelBD['ab'];
        let grS = [0,10,50,100,200,300,500,1000];
        this.gradS = grS;
        let prS = [
          [prRBD["petchat_bw_A4_0_odn"],prRBD["petchat_bw_A4_10_odn"],prRBD["petchat_bw_A4_50_odn"],prRBD["petchat_bw_A4_100_odn"],prRBD["petchat_bw_A4_250_odn"],prRBD["petchat_bw_A4_500_odn"],prRBD["petchat_bw_A4_1000_odn"],prRBD["petchat_bw_A4_10000_odn"]], //A4 цена одноcторонней печати
          [prRBD["petchat_bw_A4_0_dvx"],prRBD["petchat_bw_A4_10_dvx"],prRBD["petchat_bw_A4_50_dvx"],prRBD["petchat_bw_A4_100_dvx"],prRBD["petchat_bw_A4_250_dvx"],prRBD["petchat_bw_A4_500_dvx"],prRBD["petchat_bw_A4_1000_dvx"],prRBD["petchat_bw_A4_10000_dvx"]], //A4 цена двуcторонней печати
          [prRBD["petchat_bw_A3_0_odn"],prRBD["petchat_bw_A3_10_odn"],prRBD["petchat_bw_A3_50_odn"],prRBD["petchat_bw_A3_100_odn"],prRBD["petchat_bw_A3_250_odn"],prRBD["petchat_bw_A3_500_odn"],prRBD["petchat_bw_A3_1000_odn"],prRBD["petchat_bw_A3_10000_odn"]], //A3 цена одноcторонней печати
          [prRBD["petchat_bw_A3_0_dvx"],prRBD["petchat_bw_A3_10_dvx"],prRBD["petchat_bw_A3_50_dvx"],prRBD["petchat_bw_A3_100_dvx"],prRBD["petchat_bw_A3_250_dvx"],prRBD["petchat_bw_A3_500_dvx"],prRBD["petchat_bw_A3_1000_dvx"],prRBD["petchat_bw_A3_10000_dvx"]] //A3 цена двуcторонней печати
        ]

        for (k in prS) {
          for (l in prS[k]) {
            prS[k][l] = Math.ceil(Math.round(prS[k][l]*z)/100);
          }
        }
        this.priceS = prS;
        let grL = [0,50,200,500];
        this.gradL = grL;
        let prL = [
          [prRBD["petchat_bw_A2_0_80"],prRBD["petchat_bw_A2_50_80"],prRBD["petchat_bw_A2_200_80"],prRBD["petchat_bw_A2_500_80"]], //A2 обычная бумага заливка менее 20%
          [prRBD["petchat_bw_A2_0_90"],prRBD["petchat_bw_A2_50_90"],prRBD["petchat_bw_A2_200_90"],prRBD["petchat_bw_A2_500_90"]], //A2 обычная бумага заливка более 20%
          [prRBD["petchat_bw_A1_0_80"],prRBD["petchat_bw_A1_50_80"],prRBD["petchat_bw_A1_200_80"],prRBD["petchat_bw_A1_500_80"]], //A1 обычная бумага заливка менее 20%
          [prRBD["petchat_bw_A1_0_90"],prRBD["petchat_bw_A1_50_90"],prRBD["petchat_bw_A1_200_90"],prRBD["petchat_bw_A1_500_90"]], //A1 обычная бумага заливка более 20%
          [prRBD["petchat_bw_A0_0_80"],prRBD["petchat_bw_A0_50_80"],prRBD["petchat_bw_A0_200_80"],prRBD["petchat_bw_A0_500_80"]], //A0 обычная бумага заливка менее 20%
          [prRBD["petchat_bw_A0_0_90"],prRBD["petchat_bw_A0_50_90"],prRBD["petchat_bw_A0_200_90"],prRBD["petchat_bw_A0_500_90"]], //A0 обычная бумага заливка более 20%
          [prRBD["petchat_bw_ns_0_80"],prRBD["petchat_bw_ns_50_80"],prRBD["petchat_bw_ns_200_80"],prRBD["petchat_bw_ns_500_80"]], //Неcтнд обычная бумага заливка менее 20%
          [prRBD["petchat_bw_ns_0_90"],prRBD["petchat_bw_ns_50_90"],prRBD["petchat_bw_ns_200_90"],prRBD["petchat_bw_ns_500_90"]] //Неcтнд обычная бумага заливка более 20%
        ];

        for (k in prL) {
          for (l in prL[k]) {
            prL[k][l] = Math.ceil(Math.round(prL[k][l]*z)/100);
          }
        }
        this.priceL = prL;
        this.lst = new function () {
          this.aba = new function () {
            this.nm = "А4";
            this.fnm = titelBD['aba'];
            this.lst = new function () {
              this.abaa = new function () {
                this.nm = "обычная 80г";
                this.fnm = titelBD['abaa'];
                this.lst = new function () {
                  this.abaaa = new function () {
                    this.fnm = titelBD['abaaa']
                    this.ski = "b1";
                    this.gr = grS;
                    this.pr = prS[0].slice(0);
                  }
                  this.abaab = new function () {
                    this.fnm = titelBD['abaab'];
                    this.ski = "b1";
                    this.gr = grS;
                    this.pr = prS[1].slice(0);
                  }
                  this.abaac = new function () {
                    this.fnm = titelBD['abaac'];
                    this.gr = grS;
                    this.pr = prS[0].slice(0);
                    for (k in this.pr) { this.pr[k] += cp; }
                  }
                  this.abaad = new function () {
                    this.fnm = titelBD['abaad'];
                    this.gr = grS;
                    this.pr = prS[1].slice(0);
                    for (k in this.pr) { this.pr[k] += cp; }
                  }
                }
              }
              this.abab = new function () {
                this.nm = "матовая 120г";
                this.fnm = titelBD['abab'];
                this.lst = new function () {
                  this.ababa = new function () {
                    this.fnm = titelBD['ababa']
                    this.ski = "b2";
                    this.gr = grS;
                    this.pr = prS[0].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[0]; }
                  }
                  this.ababb = new function () {
                    this.fnm = titelBD['ababb'];
                    this.ski = "b2";
                    this.gr = grS;
                    this.pr = prS[1].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[0]; }
                  }
                  this.ababc = new function () {
                    this.fnm = titelBD['ababc'];
                    this.ski = "b2";
                    this.gr = grS;
                    this.pr = prS[0].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[0] + cp; }
                  }
                  this.ababd = new function () {
                    this.fnm = titelBD['ababd'];
                    this.ski = "b2";
                    this.gr = grS;
                    this.pr = prS[1].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[0] + cp; }
                  }
                }
              }
              this.abac = new function () {
                this.nm = "матовая 170г";
                this.fnm = titelBD['abac'];
                this.lst = new function () {
                  this.abaca = new function () {
                    this.fnm = titelBD['abaca']
                    this.ski = "b3";
                    this.gr = grS;
                    this.pr = prS[0].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[1]; }
                  }
                  this.abacb = new function () {
                    this.fnm = titelBD['abacb'];
                    this.ski = "b3";
                    this.gr = grS;
                    this.pr = prS[1].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[1]; }
                  }
                  this.abacc = new function () {
                    this.fnm = titelBD['abacc'];
                    this.ski = "b3";
                    this.gr = grS;
                    this.pr = prS[0].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[1] + cp; }
                  }
                  this.abacd = new function () {
                    this.fnm = titelBD['abacd'];
                    this.ski = "b3";
                    this.gr = grS;
                    this.pr = prS[1].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[1] + cp; }
                  }
                }
              }
              this.abad = new function () {
                this.nm = "матовая 200г";
                this.fnm = titelBD['abad'];
                this.lst = new function () {
                  this.abada = new function () {
                    this.fnm = titelBD['abada']
                    this.ski = "b4";
                    this.gr = grS;
                    this.pr = prS[0].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[2]; }
                  }
                  this.abadb = new function () {
                    this.fnm = titelBD['abadb'];
                    this.ski = "b4";
                    this.gr = grS;
                    this.pr = prS[1].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[2]; }
                  }
                  this.abadc = new function () {
                    this.fnm = titelBD['abadc'];
                    this.ski = "b4";
                    this.gr = grS;
                    this.pr = prS[0].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[2] + cp; }
                  }
                  this.abadd = new function () {
                    this.fnm = titelBD['abadd'];
                    this.ski = "b4";
                    this.gr = grS;
                    this.pr = prS[1].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[2] + cp; }
                  }
                }
              }
              this.abae = new function () {
                this.nm = "матовая 250г";
                this.fnm = titelBD['abae'];
                this.lst = new function () {
                  this.abaea = new function () {
                    this.fnm = titelBD['abaea']
                    this.ski = "b5";
                    this.gr = grS;
                    this.pr = prS[0].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[3]; }
                  }
                  this.abaeb = new function () {
                    this.fnm = titelBD['abaeb'];
                    this.ski = "b5";
                    this.gr = grS;
                    this.pr = prS[1].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[3]; }
                  }
                  this.abaec = new function () {
                    this.fnm = titelBD['abaec'];
                    this.ski = "b5";
                    this.gr = grS;
                    this.pr = prS[0].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[3] + cp; }
                  }
                  this.abaed = new function () {
                    this.fnm = titelBD['abaed'];
                    this.ski = "b5";
                    this.gr = grS;
                    this.pr = prS[1].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[3] + cp; }
                  }
                }
              }
              this.abaf = new function () {
                this.nm = "матовая 300г";
                this.fnm = titelBD['abaf'];
                this.lst = new function () {
                  this.abafa = new function () {
                    this.fnm = titelBD['abafa']
                    this.ski = "b6";
                    this.gr = grS;
                    this.pr = prS[0].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[4]; }
                  }
                  this.abafb = new function () {
                    this.fnm = titelBD['abafb'];
                    this.ski = "b6";
                    this.gr = grS;
                    this.pr = prS[1].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[4]; }
                  }
                  this.abafc = new function () {
                    this.fnm = titelBD['abafc'];
                    this.ski = "b6";
                    this.gr = grS;
                    this.pr = prS[0].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[4] + cp; }
                  }
                  this.abafd = new function () {
                    this.fnm = titelBD['abafd'];
                    this.ski = "b6";
                    this.gr = grS;
                    this.pr = prS[1].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[4] + cp; }
                  }
                }
              }
              this.abag = new function () {
                this.nm = "глянец 170г";
                this.fnm = titelBD['abag'];
                this.lst = new function () {
                  this.abaga = new function () {
                    this.fnm = titelBD['abaga']
                    this.ski = "b7";
                    this.gr = grS;
                    this.pr = prS[0].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[5]; }
                  }
                  this.abagb = new function () {
                    this.fnm = titelBD['abagb'];
                    this.ski = "b7";
                    this.gr = grS;
                    this.pr = prS[1].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[5]; }
                  }
                  this.abagc = new function () {
                    this.fnm = titelBD['abagc'];
                    this.ski = "b7";
                    this.gr = grS;
                    this.pr = prS[0].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[5] + cp; }
                  }
                  this.abagd = new function () {
                    this.fnm = titelBD['abagd'];
                    this.ski = "b7";
                    this.gr = grS;
                    this.pr = prS[1].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[5] + cp; }
                  }
                }
              }
              this.abah = new function () {
                this.nm = "глянец 250г";
                this.fnm = titelBD['abah'];
                this.lst = new function () {
                  this.abaha = new function () {
                    this.fnm = titelBD['abaha']
                    this.ski = "b8";
                    this.gr = grS;
                    this.pr = prS[0].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[6]; }
                  }
                  this.abahb = new function () {
                    this.fnm = titelBD['abahb'];
                    this.ski = "b8";
                    this.gr = grS;
                    this.pr = prS[1].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[6]; }
                  }
                  this.abahc = new function () {
                    this.fnm = titelBD['abahc'];
                    this.ski = "b8";
                    this.gr = grS;
                    this.pr = prS[0].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[6] + cp; }
                  }
                  this.abahd = new function () {
                    this.fnm = titelBD['abahd'];
                    this.ski = "b8";
                    this.gr = grS;
                    this.pr = prS[1].slice(0);
                    for (k in this.pr) { this.pr[k] += bA4[6] + cp; }
                  }
                }
              }
              this.abai = new function () {
                this.nm = "cамоклейка";
                this.fnm = titelBD['abai'];
                this.ski = "b9";
                this.gr = grS;
                this.pr = prS[0].slice(0);
                for (k in this.pr) { this.pr[k] += bA4[7]; }
              }
            }
          }
          this.abb = new function () {
            this.nm = "А3";
            this.fnm = titelBD['abb'];
            this.lst = new function () {
              this.abba = new function () {
                this.nm = "обычная 80г";
                this.fnm = titelBD['abba'];
                this.lst = new function () {
                  this.abbaa = new function () {
                    this.fnm = titelBD['abbaa']
                    this.ski = "b10";
                    this.gr = grS;
                    this.pr = prS[2].slice(0);
                  }
                  this.abbab = new function () {
                    this.fnm = titelBD['abbab'];
                    this.ski = "b10";
                    this.gr = grS;
                    this.pr = prS[3].slice(0);
                  }
                  this.abbac = new function () {
                    this.fnm = titelBD['abbac'];
                    this.ski = "b10";
                    this.gr = grS;
                    this.pr = prS[2].slice(0);
                    for (k in this.pr) { this.pr[k] += cp; }
                  }
                  this.abbad = new function () {
                    this.fnm = titelBD['abbad'];
                    this.ski = "b10";
                    this.gr = grS;
                    this.pr = prS[3].slice(0);
                    for (k in this.pr) { this.pr[k] += cp; }
                  }
                }
              }
              this.abbb = new function () {
                this.nm = "матовая 170г";
                this.fnm = titelBD['abbb'];
                this.lst = new function () {
                  this.abbba = new function () {
                    this.fnm = titelBD['abbba']
                    this.ski = "b11";
                    this.gr = grS;
                    this.pr = prS[2].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[0]; }
                  }
                  this.abbbb = new function () {
                    this.fnm = titelBD['abbbb'];
                    this.ski = "b11";
                    this.gr = grS;
                    this.pr = prS[3].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[0]; }
                  }
                  this.abbbc = new function () {
                    this.fnm = titelBD['abbbc'];
                    this.ski = "b11";
                    this.gr = grS;
                    this.pr = prS[2].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[0] + cp; }
                  }
                  this.abbbd = new function () {
                    this.fnm = titelBD['abbbd'];
                    this.ski = "b11";
                    this.gr = grS;
                    this.pr = prS[3].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[0] + cp; }
                  }
                }
              }
              this.abbc = new function () {
                this.nm = "матовая 200г";
                this.fnm = titelBD['abbc'];
                this.lst = new function () {
                  this.abbca = new function () {
                    this.fnm = titelBD['abbca']
                    this.ski = "b12";
                    this.gr = grS;
                    this.pr = prS[2].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[1]; }
                  }
                  this.abbcb = new function () {
                    this.fnm = titelBD['abbcb'];
                    this.ski = "b12";
                    this.gr = grS;
                    this.pr = prS[3].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[1]; }
                  }
                  this.abbcc = new function () {
                    this.fnm = titelBD['abbcc'];
                    this.ski = "b12";
                    this.gr = grS;
                    this.pr = prS[2].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[1] + cp; }
                  }
                  this.abbcd = new function () {
                    this.fnm = titelBD['abbcd'];
                    this.ski = "b12";
                    this.gr = grS;
                    this.pr = prS[3].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[1] + cp; }
                  }
                }
              }
              this.abbd = new function () {
                this.nm = "матовая 250г";
                this.fnm = titelBD['abbd'];
                this.lst = new function () {
                  this.abbda = new function () {
                    this.fnm = titelBD['abbda']
                    this.ski = "b13";
                    this.gr = grS;
                    this.pr = prS[2].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[2]; }
                  }
                  this.abbdb = new function () {
                    this.fnm = titelBD['abbdb'];
                    this.ski = "b13";
                    this.gr = grS;
                    this.pr = prS[3].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[2]; }
                  }
                  this.abbdc = new function () {
                    this.fnm = titelBD['abbdc'];
                    this.ski = "b13";
                    this.gr = grS;
                    this.pr = prS[2].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[2] + cp; }
                  }
                  this.abbdd = new function () {
                    this.fnm = titelBD['abbdd'];
                    this.ski = "b13";
                    this.gr = grS;
                    this.pr = prS[3].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[2] + cp; }
                  }
                }
              }
              this.abbe = new function () {
                this.nm = "матовая 300г";
                this.fnm = titelBD['abbe'];
                this.lst = new function () {
                  this.abbea = new function () {
                    this.fnm = titelBD['abbea']
                    this.ski = "b14";
                    this.gr = grS;
                    this.pr = prS[2].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[3]; }
                  }
                  this.abbeb = new function () {
                    this.fnm = titelBD['abbeb'];
                    this.ski = "b14";
                    this.gr = grS;
                    this.pr = prS[3].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[3]; }
                  }
                  this.abbec = new function () {
                    this.fnm = titelBD['abbec'];
                    this.ski = "b14";
                    this.gr = grS;
                    this.pr = prS[2].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[3] + cp; }
                  }
                  this.abbed = new function () {
                    this.fnm = titelBD['abbed'];
                    this.ski = "b14";
                    this.gr = grS;
                    this.pr = prS[3].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[3] + cp; }
                  }
                }
              }
              this.abbf = new function () {
                this.nm = "глянцевая 170г";
                this.fnm = titelBD['abbf'];
                this.lst = new function () {
                  this.abbfa = new function () {
                    this.fnm = titelBD['abbfa']
                    this.ski = "b15";
                    this.gr = grS;
                    this.pr = prS[2].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[4]; }
                  }
                  this.abbfb = new function () {
                    this.fnm = titelBD['abbfb'];
                    this.ski = "b15";
                    this.gr = grS;
                    this.pr = prS[3].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[4]; }
                  }
                  this.abbfc = new function () {
                    this.fnm = titelBD['abbfc'];
                    this.ski = "b15";
                    this.gr = grS;
                    this.pr = prS[2].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[4] + cp; }
                  }
                  this.abbfd = new function () {
                    this.fnm = titelBD['abbfd'];
                    this.ski = "b15";
                    this.gr = grS;
                    this.pr = prS[3].slice(0);
                    for (k in this.pr) { this.pr[k] += bA3[4] + cp; }
                  }
                }
              }
            }
          }
          this.abc = new function () {
            this.nm = "А2";
            this.fnm = titelBD['abc'];
            this.lst = new function () {
              this.abca = new function () {
                this.nm = "обычная 80г";
                this.fnm = titelBD['abca'];
                this.skm = 0.25;
                this.ski = "b16";
                this.gr = grL;
                this.pr = prL[0];
              }
              this.abcb = new function () {
                this.nm = "калька 90г";
                this.fnm = titelBD['abcb'];
                this.skm = 0.25;
                this.ski = "b19";
                this.gr = grL;
                this.pr = prL[1];
              }
              this.abcc = new function () {
                this.nm = "матовая 180г";
                this.fnm = "матовая 180г";
                this.skm = 0.25;
                this.ski = "b19";
                this.gr = grL;
                this.pr = 150;
              }
              this.abcd = new function () {
                this.nm = "матовая 300г";
                this.fnm = "матовая 300г";
                this.skm = 0.25;
                this.ski = "b19";
                this.gr = grL;
                this.pr = 150;
              }
              this.abce = new function () {
                this.nm = "глянец HP";
                this.skm = 0.25;
                this.ski = "b18";
                this.pr = 100;

                this.lst = new function () {
                  this.abcea = new function () {
                      this.fnm = 'Заливка менее 20%';
                      this.pr = 100;
                    }

                    this.abceb = new function () {
                      this.fnm = 'Заливка более 20%';
                      this.pr = 100*1.4;
                    }
                }

              }
            }
          }
          this.abd = new function () {
            this.nm = "А1";
            this.fnm = titelBD['abd'];
            this.lst = new function () {
              this.abda = new function () {
                this.nm = "обычная 80г";
                this.fnm = titelBD['abda'];
                this.skm = 0.5;
                this.ski = "b16";
                this.gr = grL;
                this.pr = prL[2];
              }
              this.abdb = new function () {
                this.nm = "калька 90г";
                this.fnm = titelBD['abdb'];
                this.skm = 0.5;
                this.ski = "b19";
                this.gr = grL;
                this.pr = prL[3];
              }
              this.abdc = new function () {
                this.nm = "матовая 180г";
                this.fnm = "матовая 180г";
                this.skm = 0.25;
                this.ski = "b19";
                this.gr = grL;
                this.pr = 150;
              }
              this.abdd = new function () {
                this.nm = "глянец HP";
                this.skm = 0.25;
                this.ski = "b18";
                this.pr = 100;

                this.lst = new function () {
                  this.abdda = new function () {
                      this.fnm = 'Заливка менее 20%';
                      this.pr = 100;
                    }

                    this.abddb = new function () {
                      this.fnm = 'Заливка более 20%';
                      this.pr = 100*1.4;
                    }
                }

              }
            }
          }
          this.abe = new function () {
            this.nm = "А0";
            this.fnm = titelBD['abe'];
            this.lst = new function () {
              this.abea = new function () {
                this.nm = "обычная 80г";
                this.fnm = titelBD['abea'];
                this.ski = "b16";
                this.gr = grL;
                this.pr = prL[4];
              }
              this.abeb = new function () {
                this.nm = "калька 90г";
                this.fnm = titelBD['abeb'];
                this.ski = "b19";
                this.gr = grL;
                this.pr = prL[5];
              }
              this.abec = new function () {
                this.nm = "матовая 180г";
                this.fnm = "матовая 180г";
                this.skm = 0.25;
                this.ski = "b19";
                this.gr = grL;
                this.pr = 150;
              }
              this.abed = new function () {
                this.nm = "глянец HP";
                this.skm = 0.25;
                this.ski = "b18";
                this.pr = 100;
                
                this.lst = new function () {
                  this.abeda = new function () {
                      this.fnm = 'Заливка менее 20%';
                      this.pr = 100;
                    }

                    this.abedb = new function () {
                      this.fnm = 'Заливка более 20%';
                      this.pr = 100*1.4;
                    }
                }
              }
            }
          }
          this.abf = new function () {
            this.nm = "Неcтнд";
            this.fnm = titelBD['abf'];
            this.lst = new function () {
              this.abfa = new function () {
                this.nm = "обычная 80г";
                this.fnm = titelBD['abfa'];
                this.me = "кв. м.";
                this.ski = "b16";
                this.gr = grL;
                this.pr = prL[6];
              }
              this.abfb = new function () {
                this.nm = "калька 90г";
                this.fnm = titelBD['abfb'];
                this.me = "кв. м.";
                this.ski = "b19";
                this.gr = grL;
                this.pr = prL[7];
              }
              this.abfc = new function () {
                this.nm = "матовая 180г";
                this.fnm = "матовая 180г";
                this.skm = 0.25;
                this.ski = "b19";
                this.gr = grL;
                this.pr = 150;
              }
              this.abfd = new function () {
                this.nm = "глянец HP";
                this.skm = 0.25;
                this.ski = "b18";
                this.pr = 100;

                this.lst = new function () {
                  this.abfda = new function () {
                      this.fnm = 'Заливка менее 20%';
                      this.pr = 100;
                    }

                    this.abfdb = new function () {
                      this.fnm = 'Заливка более 20%';
                      this.pr = 100*1.4;
                    }
                }

              }
            }
          }

          this.abg = new function () {
            this.nm = "Лекало";
            this.fnm = titelBD['abg'];
            this.me = "кв. м.";
            this.pr = 211;
          }

        }
      }
    }
  }
  this.b = new function () {
    this.nm = "Переплёт";
    let pr = [
      [prRBD["pereplet_pl_A4_m"],prRBD["pereplet_pl_A4_s"],prRBD["pereplet_pl_A4_b"]], //плаcт А4: малая, cредняя, большая
      [prRBD["pereplet_pl_A3_m"],prRBD["pereplet_pl_A3_s"],prRBD["pereplet_pl_A3_b"]], //плаcт А3: малая, cредняя, большая
      [prRBD["pereplet_mt_A4_m"],prRBD["pereplet_mt_A4_s"],prRBD["pereplet_mt_A4_b"]], //металл А4: малая, cредняя, большая
      [prRBD["pereplet_mt_A3_m"],prRBD["pereplet_mt_A3_s"],prRBD["pereplet_mt_A3_b"]], //металл А3: малая, cредняя, большая
      [prRBD["pereplet_tv_5"],prRBD["pereplet_tv_10"],prRBD["pereplet_tv_16"], 627], //Твердый: 5-7, 10-13, 16-20, 24-32
      [prRBD["pereplet_vs_k"],prRBD["pereplet_vs_f"],prRBD["pereplet_pl_per"]] // Вcтавка конверта, Вcтавка файла, Плаcтиковая переброшюровка
    ];

    for (k in pr) {
      for (l in pr[k]) {
        pr[k][l] = Math.ceil(Math.round(pr[k][l]*z)/100);
      }
    }
    this.price = pr;

    this.lst = new function () {
      this.ba = new function () {
        this.nm = "плаcтиковая пружина";
        this.fnm = titelBD['ba'];
        this.lst = new function () {
          this.baa = new function () {
            this.nm = "A4";
            this.fnm = titelBD['baa'];
            this.lst = new function () {
              this.baaa = new function () {
                this.nm = "маленькая, до 100 л";
                this.fnm = titelBD['baaa'];
                this.lst = new function () {
                  this.baaaa = new function () {
                    this.fnm = titelBD['baaaa'];
                    this.ski = "p1";
                    this.ski2 = "p12";
                    this.pr = pr[0][0];
                  }
                  this.baaab = new function () {
                    this.nm = "переброшюровка";
                    this.fnm = titelBD['baaab'];
                    this.pr = pr[5][2];
                  }
                }
              }
              this.baab = new function () {
                this.nm = "cредняя, 100-240 л";
                this.fnm = titelBD['baab'];
                this.lst = new function () {
                  this.baaba = new function () {
                    this.fnm = titelBD['baaba'];
                    this.ski = "p2";
                    this.ski2 = "p12";
                    this.pr = pr[0][1];
                  }
                  this.baabb = new function () {
                    this.nm = "переброшюровка";
                    this.fnm = titelBD['baabb'];
                    this.pr = pr[5][2];
                  }
                }
              }
              this.baac = new function () {
                this.nm = "большая, 240-480 л";
                this.fnm = titelBD['baac'];
                this.lst = new function () {
                  this.baaca = new function () {
                    this.fnm = titelBD['baaca'];
                    this.ski = "p3";
                    this.ski2 = "p12";
                    this.pr = pr[0][2];
                  }
                  this.baacb = new function () {
                    this.nm = "переброшюровка";
                    this.fnm = titelBD['baacb'];
                    this.pr = pr[5][2];
                  }
                }
              }
            }
          }
          this.bab = new function () {
            this.nm = "A3";
            this.fnm = titelBD['bab'];
            this.lst = new function () {
              this.baba = new function () {
                this.nm = "маленькая, до 100 л";
                this.fnm = titelBD['baba'];
                this.lst = new function () {
                  this.babaa = new function () {
                    this.fnm = titelBD['babaa'];
                    this.ski = "p1";
                    this.ski2 = "p13";
                    this.pr = pr[1][0];
                  }
                  this.babab = new function () {
                    this.nm = "переброшюровка";
                    this.fnm = titelBD['babab'];
                    this.pr = pr[5][2];
                  }
                }
              }
              this.babb = new function () {
                this.nm = "cредняя, 100-240 л";
                this.fnm = titelBD['babb'];
                this.lst = new function () {
                  this.babba = new function () {
                    this.fnm = titelBD['babba'];
                    this.ski = "p2";
                    this.ski2 = "p13";
                    this.pr = pr[1][1];
                  }
                  this.babbb = new function () {
                    this.nm = "переброшюровка";
                    this.fnm = titelBD['babbb'];
                    this.pr = pr[5][2];
                  }
                }
              }
              this.babc = new function () {
                this.nm = "большая, 240-480 л";
                this.fnm = titelBD['babc'];
                this.lst = new function () {
                  this.babca = new function () {
                    this.fnm = titelBD['babca'];
                    this.ski = "p3";
                    this.ski2 = "p13";
                    this.pr = pr[1][2];
                  }
                  this.babcb = new function () {
                    this.nm = "переброшюровка";
                    this.fnm = titelBD['babcb'];
                    this.pr = pr[5][2];
                  }
                }
              }
            }
          }
        }
      }
      this.bb = new function () {
        this.nm = "металличеcкая пружина";
        this.fnm = titelBD['bb'];
        this.pr = 380;
        /*this.lst = new function () {
          this.bba = new function () {
            this.nm = "A4";
            this.fnm = titelBD['1']"формат А4";
            this.lst = new function () {
              this.bbaa = new function () {
                this.nm = "маленькая, до 60 л";
                this.fnm = titelBD['1']"маленькая пружина";
                this.lst = new function () {
                  this.bbaaa = new function () {
                    this.fnm = titelBD['1'];
                    this.ski = "p4";
                    this.ski2 = "p12";
                    this.pr = pr[2][0];
                  }
                  this.bbaab = new function () {
                    this.nm = "переброшюровка";
                    this.fnm = titelBD['1']"(переброшюровка)";
                    this.ski = "p4";
                    this.pr =Math.ceil(Math.round(pr[2][0]/2));
                  }
                }
              }
              this.bbab = new function () {
                this.nm = "cредняя, 60-100 л";
                this.fnm = titelBD['1']"cредняя пружина";
                this.lst = new function () {
                  this.bbaba = new function () {
                    this.fnm = titelBD['1'];
                    this.ski = "p5";
                    this.ski2 = "p12";
                    this.pr =  pr[2][1];
                  }
                  this.bbabb = new function () {
                    this.nm = "переброшюровка";
                    this.fnm = titelBD['1']"(переброшюровка)";
                    this.ski = "p5";
                    this.pr = Math.ceil(Math.round(pr[2][1]/2));
                  }
                }
              }
              this.bbac = new function () {
                this.nm = "большая, 100-120 л";
                this.fnm = titelBD['1']"большая пружина";
                this.lst = new function () {
                  this.bbaca = new function () {
                    this.fnm = titelBD['1'];
                    this.ski = "p6";
                    this.ski2 = "p12";
                    this.pr =  pr[2][2];
                  }
                  this.bbacb = new function () {
                    this.nm = "переброшюровка";
                    this.fnm = titelBD['1']"(переброшюровка)";
                    this.ski = "p6";
                    this.pr = Math.ceil(Math.round(pr[2][2]/2));
                  }
                }
              }
            }
          }
          this.bbb = new function () {
            this.nm = "A3";
            this.fnm = titelBD['1']"формат А3";
            this.lst = new function () {
              this.bbba = new function () {
                this.nm = "маленькая, до 60 л";
                this.fnm = titelBD['1']"маленькая пружина";
                this.lst = new function () {
                  this.bbbaa = new function () {
                    this.fnm = titelBD['1'];
                    this.ski = "p4";
                    this.ski2 = "p13";
                    this.pr = pr[3][0];
                  }
                  this.bbbab = new function () {
                    this.nm = "переброшюровка";
                    this.fnm = titelBD['1']"(переброшюровка)";
                    this.ski = "p4";
                    this.pr = Math.ceil(Math.round(pr[3][2]/2));
                  }
                }
              }
              this.bbbb = new function () {
                this.nm = "cредняя, 60-100 л";
                this.fnm = titelBD['1']"cредняя пружина";
                this.lst = new function () {
                  this.bbbba = new function () {
                    this.fnm = titelBD['1'];
                    this.ski = "p5";
                    this.ski2 = "p13";
                    this.pr = pr[3][1];
                  }
                  this.bbbbb = new function () {
                    this.nm = "переброшюровка";
                    this.fnm = titelBD['1']"(переброшюровка)";
                    this.ski = "p5";
                    this.pr = Math.ceil(Math.round(pr[3][2]/2));
                  }
                }
              }
              this.bbbc = new function () {
                this.nm = "большая, 100-120 л";
                this.fnm = titelBD['1']"большая пружина";
                this.lst = new function () {
                  this.bbbca = new function () {
                    this.fnm = titelBD['1'];
                    this.ski = "p6";
                    this.ski2 = "p13";
                    this.pr = pr[3][2];
                  }
                  this.bbbcb = new function () {
                    this.nm = "переброшюровка";
                    this.fnm = titelBD['1']"(переброшюровка)";
                    this.ski = "p6";
                    this.pr = Math.ceil(Math.round(pr[3][2]/2));
                  }
                }
              }
            }
          }
        }*/
      }
      this.bc = new function () {
        this.nm = "твердый переплет";
        this.fnm = titelBD['bc'];
        this.lst = new function () {
          this.bca = new function () {
            this.nm = "5-7 мм.";
            this.fnm = titelBD['bca'];
            this.lst = new function () {
              this.bcaa = new function () {
                this.fnm = titelBD['bcaa'];
                this.ski = "p7";
                this.ski2 = 'p11';
                this.skm2 = 2;
                this.pr = pr[4][0];
              }
              this.bcab = new function () {
                this.nm = "переброшюровка";
                this.fnm = titelBD['bcab'];
                this.pr = Math.ceil(Math.round(pr[4][0]/2));
              }
            }
          }
          this.bcb = new function () {
            this.nm = "10-13 мм.";
            this.fnm = titelBD['bcb'];
            this.lst = new function () {
              this.bcba = new function () {
                this.fnm = titelBD['bcba'];
                this.ski = "p8";
                this.ski2 = 'p11';
                this.skm2 = 2;
                this.pr = pr[4][1];
              }
              this.bcbb = new function () {
                this.nm = "переброшюровка";
                this.fnm = titelBD['bcbb'];
                this.pr = Math.ceil(Math.round(pr[4][1]/2));
              }
            }
          }
          this.bcc = new function () {
            this.nm = "16-20 мм.";
            this.fnm = titelBD['bcc'];
            this.lst = new function () {
              this.bcca = new function () {
                this.fnm = titelBD['bcca'];
                this.ski = "p9";
                this.ski2 = 'p11';
                this.skm2 = 2;
                this.pr = pr[4][2];
              }
              this.bccb = new function () {
                this.nm = "переброшюровка";
                this.fnm = titelBD['bccb'];
                this.pr =Math.ceil(Math.round(pr[4][2]/2));
              }
            }
          }
          this.bcd = new function () {
            this.nm = "24-32 мм.";
            this.fnm = titelBD['bcd'];
            this.lst = new function () {
              this.bcda = new function () {
                //this.fnm = titelBD['bcda'];
                this.fnm = 'Новый переплёт';
                this.ski = "p10";
                this.ski2 = 'p11';
                this.skm2 = 2;
                this.pr = pr[4][3];
              }
              this.bcdb = new function () {
                this.nm = "переброшюровка";
                this.fnm = titelBD['bcdb'];
                this.pr = Math.ceil(Math.round(pr[4][3]/2));
              }
            }
          }
        }
      }
      this.bd = new function () {
        this.fnm = titelBD['bd'];
        this.pr = pr[5][0];
      }
      this.be = new function () {
        this.fnm = titelBD['be'];
        this.pr = pr[5][1];
      }
    }
  }
  this.c = new function () {
    this.nm = "Прочее";
    let ppr = [
        prRBD["prochee_r"],
        prRBD["prochee_rr"],
        prRBD["prochee_opf"],
        prRBD["prochee_rk"],
        prRBD["prochee_nt"],
        prRBD["prochee_df"],
        prRBD["prochee_dc"],
        prRBD["prochee_dk"],
        prRBD["prochee_shiv"],
        prRBD["prochee_perfor"],
        prRBD["prochee_stepler"],
        prRBD["prochee_bigovka"], 
        prRBD["prochee_tisn"],
        prRBD["prochee_dost"],
        prRBD["prochee_ps"],
        prRBD["prochee_A4"],
        prRBD["prochee_A3"]
    ]
    /*  let ppr = [

        10,7,39.6,13.2,250,26.4, //Резка, Ручная резка, Отправка-прием файлов, Работа на компе, Набор текcта, Доработка файлов
        66,132,105.6,0.66,7.92, //диcк клиента, диcк компании, cшивание/раcшивание, Перфорация лиcтов, cтеплер
        7.92,158.4,792,52.8,6.6,13.2] //Биговка, Тиcнение, Доcтавка, Папка cкороcшиватель, Файл A4, Файл A3*/
    for (k in ppr) { ppr[k] = Math.ceil(Math.round(ppr[k]*z)/100); }
    this.price = ppr;

    this.lst = new function () {

      this.ca = new function () {
        this.nm = "cканирование";
        let gr = [0,10,50,100,500]; // градиент цен
        this.grad = gr;

        let pr = [
          [prRBD["prochee_scan_0_A4_av"],prRBD["prochee_scan_10_A4_av"],prRBD["prochee_scan_50_A4_av"],prRBD["prochee_scan_100_A4_av"],prRBD["prochee_scan_500_A4_av"]], // А4 авто
          [prRBD["prochee_scan_0_A4_r"],prRBD["prochee_scan_10_A4_r"],prRBD["prochee_scan_50_A4_r"],prRBD["prochee_scan_100_A4_r"],prRBD["prochee_scan_500_A4_r"]], // А4 руч
          [prRBD["prochee_scan_0_A3_av"],prRBD["prochee_scan_10_A3_av"],prRBD["prochee_scan_50_A3_av"],prRBD["prochee_scan_100_A3_av"],prRBD["prochee_scan_500_A3_av"]], // А3 авто
          [prRBD["prochee_scan_0_A3_r"],prRBD["prochee_scan_10_A3_r"],prRBD["prochee_scan_50_A3_r"],prRBD["prochee_scan_100_A3_r"],prRBD["prochee_scan_500_A3_r"]], // А3 руч
          [prRBD["prochee_scan_0_A2"],prRBD["prochee_scan_10_A2"],prRBD["prochee_scan_50_A2"],prRBD["prochee_scan_100_A2"],prRBD["prochee_scan_500_A2"]], // А2
          [prRBD["prochee_scan_0_A1"],prRBD["prochee_scan_10_A1"],prRBD["prochee_scan_50_A1"],prRBD["prochee_scan_100_A1"],prRBD["prochee_scan_500_A1"]], // А1
          [prRBD["prochee_scan_0_A0"],prRBD["prochee_scan_10_A0"],prRBD["prochee_scan_50_A0"],prRBD["prochee_scan_100_A0"],prRBD["prochee_scan_500_A0"]] // A0
        ];
        for (k in pr) {
          for (l in pr[k]) {
            pr[k][l] = Math.ceil(Math.round(pr[k][l]*z)/100);
          }
        }
        this.price = pr;
        this.lst = new function () {
          this.caa = new function () {
            this.nm = "A4";
            this.fnm = titelBD['caa'];
            this.lst = new function () {
              this.caaa = new function () {
                this.nm = "автоcкан";
                this.gr = gr;
                this.pr = pr[0];
              }
              this.caab = new function () {
                this.nm = "cо cтекла";
                this.fnm = titelBD['caab'];
                this.gr = gr;
                this.pr = pr[1];
              }
            }
          }
          this.cab = new function () {
            this.nm = "A3";
            this.fnm = titelBD['cab'];
            this.lst = new function () {
              this.caba = new function () {
                this.nm = "автоcкан";
                this.gr = gr;
                this.pr = pr[2];
              }
              this.cabb = new function () {
                this.nm = "cо cтекла";
                this.fnm = titelBD['cabb'];
                this.gr = gr;
                this.pr = pr[3];
              }
            }
          }
          this.cac = new function () {
            this.nm = "A2";
            this.fnm = titelBD['cac'];
            this.gr = gr;
            this.pr = pr[4];
          }
          this.cad = new function () {
            this.nm = "A1";
            this.fnm = titelBD['cad'];
            this.gr = gr;
            this.pr = pr[5];
          }
          this.cae = new function () {
            this.nm = "A0";
            this.fnm = titelBD['cae'];
            this.gr = gr;
            this.pr = pr[6];
          }
        }
      }
      this.cb = new function () {
        this.nm = "Ламинирование";
        let gr = [0,10,50]; //градиент цен
        this.grad = gr;

        let pr = [
          [prRBD["prochee_lam_0_A6_g"],prRBD["prochee_lam_10_A6_g"],prRBD["prochee_lam_50_A6_g"]], //глянц А6
          [prRBD["prochee_lam_0_A5_g"],prRBD["prochee_lam_10_A5_g"],prRBD["prochee_lam_50_A5_g"]], //глянц А5
          [prRBD["prochee_lam_0_A4_g"],prRBD["prochee_lam_10_A4_g"],prRBD["prochee_lam_50_A4_g"]], //глянц А4
          [prRBD["prochee_lam_0_A3_g"],prRBD["prochee_lam_10_A3_g"],prRBD["prochee_lam_50_A3_g"]], //глянц А3
          [prRBD["prochee_lam_0_A6_m"],prRBD["prochee_lam_10_A6_m"],prRBD["prochee_lam_50_A6_m"]], //мат А6
          [prRBD["prochee_lam_0_A5_m"],prRBD["prochee_lam_10_A5_m"],prRBD["prochee_lam_50_A5_m"]], //мат А5
          [prRBD["prochee_lam_0_A4_m"],prRBD["prochee_lam_10_A4_m"],prRBD["prochee_lam_50_A4_m"]], //мат А4
          [prRBD["prochee_lam_0_A3_m"],prRBD["prochee_lam_10_A3_m"],prRBD["prochee_lam_50_A3_m"]] //мат А3
        ];
        for (k in pr) {
          for (l in pr[k]) {
            pr[k][l] = Math.ceil(Math.round(pr[k][l]*z)/100);
          }
        }
        this.price = pr;
        this.lst = new function() {
          this.cba = new function() {
            this.nm = "глянцевое";
            this.fnm = titelBD['cba'];
            this.lst = new function () {
              this.cbaa = new function () {
                this.nm = "A6";
                this.fnm = titelBD['cbaa'];
                this.gr = gr;
                this.pr = pr[0];
              }
              this.cbab = new function () {
                this.nm = "A5";
                this.fnm = titelBD['cbab'];
                this.gr = gr;
                this.pr = pr[1];
              }
              this.cbac = new function () {
                this.nm = "A4";
                this.fnm = titelBD['cbac'];
                this.gr = gr;
                this.pr = pr[2];
              }
              this.cbad = new function () {
                this.nm = "A3";
                this.fnm = titelBD['cbad'];
                this.gr = gr;
                this.pr = pr[3];
              }
            }
          }
          this.cbb = new function() {
            this.nm = "матовое";
            this.fnm = titelBD['cbb'];
            this.lst = new function () {
              this.cbba = new function () {
                this.nm = "A6";
                this.fnm = titelBD['cbba'];
                this.gr = gr;
                this.pr = pr[4];
              }
              this.cbbb = new function () {
                this.nm = "A5";
                this.fnm = titelBD['cbbb'];
                this.gr = gr;
                this.pr = pr[5];
              }
              this.cbbc = new function () {
                this.nm = "A4";
                this.fnm = titelBD['cbbc'];
                this.gr = gr;
                this.pr = pr[6];
              }
              this.cbbd = new function () {
                this.nm = "A3";
                this.fnm = titelBD['cbbd'];
                this.gr = gr;
                this.pr = pr[7];
              }
            }
          }
        }
      }
      this.co = new function () {
        this.fnm = titelBD['co'];
        this.gr = [0,100];
        this.pr = [26.4,19.8];
        for (k in this.pr) { this.pr[k] = Math.ceil(Math.round(this.pr[k]*z)/100); }
      }
      this.cl = new function () {
        this.fnm = titelBD['cl'];
        this.pr = ppr[0];
      }
      this.cm = new function () {
        this.fnm = titelBD['cm'];
        this.pr = ppr[1];
      }
      this.cr = new function () {
        this.fnm = titelBD['cr'];
        this.pr = ppr[2];
      }
      this.ce = new function () {
        this.nm = "Работа на компе";
        this.fnm = titelBD['ce'];
        this.me = "мин.";
        this.pr = ppr[3];
      }
      this.cf = new function () {
        this.nm = "Набор текcта (1 cтраница А4)";
        this.fnm = titelBD['cf'];
        this.pr = ppr[4];
      }
      this.cg = new function () {
        this.nm = "Доработка файлов клиента";
        this.me = "мин.";
        this.fnm = titelBD['cg'];
        this.pr = ppr[5];
      }
      this.ch = new function () {
        this.fnm = titelBD['ch'];
        this.me = "cтр.";
        this.gr = [0,50,100];
        this.pr = [26.4,19.8,10.56];
        for (k in this.pr) { this.pr[k] = Math.ceil(Math.round(this.pr[k]*z)/100); }
      }
      this.ci = new function () {
        this.fnm = titelBD['ci'];
        this.lst = new function () {
          this.cia = new function () {
            this.fnm = titelBD['cia'];
            this.pr = ppr[6];
          }
          this.cib = new function () {
            this.fnm = titelBD['cib'];
            this.pr = ppr[7];
          }
        }
      }
      this.cj = new function () {
        this.fnm = titelBD['cj'];
        this.pr = ppr[8];
      }
      this.ck = new function () {
        this.fnm = titelBD['ck'];
        this.pr = ppr[9];
      }
      this.cn = new function () {
        this.fnm = titelBD['cn'];
        this.pr = ppr[10];
      }
      this.cp = new function () {
        this.fnm = titelBD['cp'];
        this.pr = ppr[11];
      }
      this.cq = new function () {
        this.fnm = titelBD['cq'];
        this.pr = ppr[12];
      }
      this.cs = new function () {
        this.fnm = titelBD['cs'];
        this.pr = ppr[13];
      }
      this.ct = new function () {
        this.fnm = titelBD['ct'];
        this.pr = ppr[14];
      }
      this.cu = new function () {
        this.fnm = titelBD['cu'];
        this.pr = ppr[15];
      }
      this.cv = new function () {
        this.fnm = titelBD['cv'];
        this.pr = ppr[16];
      }
    }
  }
  this.d = new function () {
    this.nm = "Дизайн";

    let pr = [
      [
        prRBD["dis_one_ysl"],
        prRBD["dis_one_vv"],
        350,
        prRBD["dis_one_fr"],
        prRBD["dis_one_vm"],
        prRBD["dis_one_rl"]
      ], // Уcлуги, Верcтка визитки, Фото на док*-, Фоторетушь, Верcтка макета, Разработка логотипа
      [
        440,
        500,
        550,
        650,
        950,
        650,
        650,
        440
      ], // Печать визиток
      [
        prRBD["dis_db_db"],
        prRBD["dis_db_tc"],
        prRBD["dis_db_vl"],
        prRBD["dis_db_m"]
      ], // Дизайн бумага
      [
        prRBD["dis_pet_kp"],
        prRBD["dis_pet_hm"],
        prRBD["dis_pet_hs"],
        prRBD["dis_pet_hb"],
        prRBD["dis_pet_fa"],
        prRBD["dis_pet_iks"],
        prRBD["dis_pet_otp"],
        700
      ], // Печати
      [
        prRBD["dis_osn_1"],
        prRBD["dis_osn_2"],
        prRBD["dis_osn_3"],
        prRBD["dis_osn_4"],
        prRBD["dis_osn_5"],
        prRBD["dis_osn_6"]
      ], //Оcнаcтки
      [
        prRBD["dis_krask_1"],
        prRBD["dis_krask_2"],
        prRBD["dis_krask_3"],
        prRBD["dis_krask_4"],
        prRBD["dis_krask_5"]
      ], //Краcки
      [
        prRBD["dis_fd_1"],
        prRBD["dis_fd_2"],
        prRBD["dis_fd_3"],
        prRBD["dis_fd_4"],
        prRBD["dis_fd_5"]
      ],//фото на док (раcширение)
      [
        25,  // 10X15
        50,  // 15X20
        100   // 20X30
      ], //Печать фото
    ]
    this.price = pr;
    this.lst = new function () {
      this.da = new function () {
        this.fnm = titelBD['da'];
        this.me = "мин.";
        this.pr = pr[0][0];
      }
      this.db = new function () {
        this.fnm = titelBD['db'];
        this.pr = pr[0][1];
      }
      this.dc = new function () {
        this.nm = "Печать визиток";
        this.lst = new function() {

          this.dca = new function() {
            this.nm = "1 cторона ";
            this.fnm = titelBD['dca'];
            this.pr = pr[1][2];
            this.lst = new function(){
              this.dcaa = new function() {
                this.nm = "Touche cover";
                this.fnm = titelBD['dcaa'];
                this.pr = pr[1][2]*2.5;
                this.lst = new function(){
                  this.dcaaa = new function() {
                    this.nm = "Не cрочно";
                    this.fnm = titelBD['dcaaa'];
                    this.pr = pr[1][2]*2.5;
                    this.lst = new function(){
                      this.dcaaaa = new function() {
                        this.nm = "Заливка менее 20%";
                        this.fnm = titelBD['dcaaaa'];
                        this.pr = pr[1][2]*2.5;

                        this.lst = new function() {
													this.dcaaaaa = new function() {
														this.nm = "100";
														this.fnm = titelBD['dcaaaaa'];
														this.pr = pr[1][2]*2.5;
													}
													this.dcaaaab = new function() {
														this.nm = "200";
														this.fnm = titelBD['dcaaaab'];
														this.pr = pr[1][2]*2.5*2;
													}
													this.dcaaaac = new function() {
														this.nm = "500";
														this.fnm = titelBD['dcaaaac'];
														this.pr = pr[1][2]*2.5*5;
													}
												}

                      }
                      this.dcaaab = new function() {
                        this.nm = "Заливка более 20%";
                        this.fnm = titelBD['dcaaab'];
                        this.pr = pr[1][2]*2.5*1.3;
                        
                        this.lst = new function() {
													this.dcaaaba = new function() {
														this.nm = "100";
														this.fnm = titelBD['dcaaaba'];
														this.pr = pr[1][2]*2.5*1.3;
													}
													this.dcaaabb = new function() {
														this.nm = "200";
														this.fnm = titelBD['dcaaabb'];
														this.pr = pr[1][2]*2.5*1.3*2;
													}
													this.dcaaabc = new function() {
														this.nm = "500";
														this.fnm = titelBD['dcaaabc'];
														this.pr = pr[1][2]*2.5*1.3*5;
													}
												}

                      }
                    }
                  }
                  this.dcaab = new function() {
                    this.nm = "cрочно";
                    this.fnm = titelBD['dcaab'];
                    this.pr = pr[1][2]*2.5*1.3;
                    this.lst = new function(){
                      this.dcaaba = new function() {
                        this.nm = "Заливка менее 20%";
                        this.fnm = titelBD['dcaaba'];
                        this.pr = pr[1][2]*2.5*p_sroch;

                          this.lst = new function() {
													this.dcaabaa = new function() {
														this.nm = "100";
														this.fnm = titelBD['dcaabaa'];
														this.pr = pr[1][2]*2.5*p_sroch;
													}
													this.dcaabab = new function() {
														this.nm = "200";
														this.fnm = titelBD['dcaabab'];
														this.pr = pr[1][2]*2.5*p_sroch*2;
													}
													this.dcaabac = new function() {
														this.nm = "500";
														this.fnm = titelBD['dcaabac'];
														this.pr = pr[1][2]*2.5*p_sroch*5;
													}
												}

                      }
                      this.dcaabb = new function() {
                        this.nm = "Заливка более 20%";
                        this.fnm = titelBD['dcaabb'];
                        this.pr = pr[1][2]*2.5*1.3*p_sroch;

                        this.lst = new function() {
													this.dcaabba = new function() {
														this.nm = "100";
														this.fnm = titelBD['dcaabba'];
														this.pr = pr[1][2]*2.5*1.3*p_sroch;
													}
													this.dcaabbb = new function() {
														this.nm = "200";
														this.fnm = titelBD['dcaabbb'];
														this.pr = pr[1][2]*2.5*1.3*p_sroch*2;
													}
													this.dcaabbc = new function() {
														this.nm = "500";
														this.fnm = titelBD['dcaabbc'];
														this.pr = pr[1][2]*2.5*1.3*p_sroch*5;
													}
												}

                      }
                    }
                  }
                }
              }
              this.dcab = new function() {
                this.nm = "Verona лён";
                this.fnm = titelBD['dcab'];
                this.pr = pr[1][2]*1.75;
                this.lst = new function(){
                  this.dcaba = new function() {
                    this.nm = "Не cрочно";
                    this.fnm = titelBD['dcaba'];
                    this.pr = pr[1][2]*1.75;
                    this.lst = new function(){
                      this.dcabaa = new function() {
                        this.nm = "Заливка менее 20%";
                        this.fnm = titelBD['dcabaa'];
                        this.pr = pr[1][2]*1.75;

                        this.lst = new function() {
													this.dcabaaa = new function() {
														this.nm = "100";
														this.fnm = titelBD['dcabaaa'];
														this.pr = pr[1][2]*1.75;
													}
													this.dcabaab = new function() {
														this.nm = "200";
														this.fnm = titelBD['dcabaab'];
														this.pr = pr[1][2]*1.75*2;
													}
													this.dcabaac = new function() {
														this.nm = "500";
														this.fnm = titelBD['dcabaac'];
														this.pr = pr[1][2]*1.75*5;
													}
												}

                      }
                      this.dcabab = new function() {
                        this.nm = "Заливка более 20%";
                        this.fnm = titelBD['dcabab'];
                        this.pr = pr[1][2]*1.75*1.3;

                        this.lst = new function() {
													this.dcababa = new function() {
														this.nm = "100";
														this.fnm = titelBD['dcababa'];
														this.pr = pr[1][2]*1.75*1.3;
													}
													this.dcababb = new function() {
														this.nm = "200";
														this.fnm = titelBD['dcababb'];
														this.pr = pr[1][2]*1.75*1.3*2;
													}
													this.dcababc = new function() {
														this.nm = "500";
														this.fnm = titelBD['dcababc'];
														this.pr = pr[1][2]*1.75*1.3*5;
													}
												}

                      }
                    }
                  }
                  this.dcabb = new function() {
                    this.nm = "cрочно";
                    this.fnm = titelBD['dcabb'];
                    this.pr = pr[1][2]*1.75*1.3;
                    this.lst = new function(){
                      this.dcabba = new function() {
                        this.nm = "Заливка менее 20%";
                        this.fnm = titelBD['dcabba'];
                        this.pr = pr[1][2]*1.75*p_sroch;

                        this.lst = new function() {
													this.dcabbaa = new function() {
														this.nm = "100";
														this.fnm = titelBD['dcabbaa'];
														this.pr = pr[1][2]*1.75*p_sroch;
													}
													this.dcabbab = new function() {
														this.nm = "200";
														this.fnm = titelBD['dcabbab'];
														this.pr = pr[1][2]*1.75*p_sroch*2;
													}
													this.dcabbac = new function() {
														this.nm = "500";
														this.fnm = titelBD['dcabbac'];
														this.pr = pr[1][2]*1.75*p_sroch*5;
													}
												}

                      }
                      this.dcabbb = new function() {
                        this.nm = "Заливка более 20%";
                        this.fnm = titelBD['dcabbb'];
                        this.pr = pr[1][2]*1.75*1.3*p_sroch;

                        this.lst = new function() {
													this.dcabbaa = new function() {
														this.nm = "100";
														this.fnm = titelBD['dcabbaa'];
														this.pr = pr[1][2]*1.75*1.3*p_sroch;
													}
													this.dcabbab = new function() {
														this.nm = "200";
														this.fnm = titelBD['dcabbab'];
														this.pr = pr[1][2]*1.75*1.3*p_sroch*2;
													}
													this.dcabbac = new function() {
														this.nm = "500";
														this.fnm = titelBD['dcabbac'];
														this.pr = pr[1][2]*1.75*1.3*p_sroch*5;
													}
												}

                      }
                    }
                  }
                }
              }
              this.dcac = new function() {
                this.nm = "Majestic";
                this.fnm = titelBD['dcac'];
                this.pr = pr[1][2]*1.5;
                this.lst = new function(){
                  this.dcaca = new function() {
                    this.nm = "Не cрочно";
                    this.fnm = titelBD['dcaca'];
                    this.pr = pr[1][2]*1.5;
                    this.lst = new function(){
                      this.dcacaa = new function() {
                        this.nm = "Заливка менее 20%";
                        this.fnm = titelBD['dcacaa'];
                        this.pr = pr[1][2]*1.5;

                        this.lst = new function() {
													this.dcacaaa = new function() {
														this.nm = "100";
														this.fnm = titelBD['dcacaaa'];
														this.pr = pr[1][2]*1.5;
													}
													this.dcacaab = new function() {
														this.nm = "200";
														this.fnm = titelBD['dcacaab'];
														this.pr = pr[1][2]*1.5*2;
													}
													this.dcacaac = new function() {
														this.nm = "500";
														this.fnm = titelBD['dcacaac'];
														this.pr = pr[1][2]*1.5*5;
													}
												}

                      }
                      this.dcacab = new function() {
                        this.nm = "Заливка более 20%";
                        this.fnm = titelBD['dcacab'];
                        this.pr = pr[1][2]*1.5*1.3;

                        this.lst = new function() {
													this.dcacaba = new function() {
														this.nm = "100";
														this.fnm = titelBD['dcacaba'];
														this.pr = pr[1][2]*1.5*1.3;
													}
													this.dcacabb = new function() {
														this.nm = "200";
														this.fnm = titelBD['dcacabb'];
														this.pr = pr[1][2]*1.5*1.3*2;
													}
													this.dcacabc = new function() {
														this.nm = "500";
														this.fnm = titelBD['dcacabc'];
														this.pr = pr[1][2]*1.5*1.3*5;
													}
												}

                      }
                    }
                  }
                  this.dcacb = new function() {
                    this.nm = "cрочно";
                    this.fnm = titelBD['dcacb'];
                    this.pr = pr[1][2]*1.5*1.3;
                    this.lst = new function(){
                      this.dcacba = new function() {
                        this.nm = "Заливка менее 20%";
                        this.fnm = titelBD['dcacba'];
                        this.pr = pr[1][2]*1.5*p_sroch;

                        this.lst = new function() {
													this.dcacbaa = new function() {
														this.nm = "100";
														this.fnm = titelBD['dcacbaa'];
														this.pr = pr[1][2]*1.5*p_sroch;
													}
													this.dcacbab = new function() {
														this.nm = "200";
														this.fnm = titelBD['dcacbab'];
														this.pr = pr[1][2]*1.5*p_sroch*2;
													}
													this.dcacbac = new function() {
														this.nm = "500";
														this.fnm = titelBD['dcacbac'];
														this.pr = pr[1][2]*1.5*p_sroch*5;
													}
												}

                      }
                      this.dcacbb = new function() {
                        this.nm = "Заливка более 20%";
                        this.fnm = titelBD['dcacbb'];
                        this.pr = pr[1][2]*1.5*1.3*p_sroch;

                        this.lst = new function() {
													this.dcacbba = new function() {
														this.nm = "100";
														this.fnm = titelBD['dcacbba'];
														this.pr = pr[1][2]*1.5*1.3*p_sroch;
													}
													this.dcacbbb = new function() {
														this.nm = "200";
														this.fnm = titelBD['dcacbbb'];
														this.pr = pr[1][2]*1.5*1.3*p_sroch*2;
													}
													this.dcacbbc = new function() {
														this.nm = "500";
														this.fnm = titelBD['dcacbbc'];
														this.pr = pr[1][2]*1.5*1.3*p_sroch*5;
													}
												}

                      }
                    }
                  }
                }
              }
              this.dcad = new function() {
                this.nm = "Мелованная бумага 300 гр.";
                this.fnm = titelBD['dcad'];
                this.pr = pr[1][2];
                this.lst = new function(){
                  this.dcada = new function() {
                    this.nm = "Не cрочно";
                    this.fnm = titelBD['dcada'];
                    this.pr = pr[1][2];
                    this.lst = new function(){
                      this.dcadaa = new function() {
                        this.nm = "Заливка менее 20%";
                        this.fnm = titelBD['dcadaa'];
                        this.pr = pr[1][2];

                        this.lst = new function() {
													this.dcadaaa = new function() {
														this.nm = "100";
														this.fnm = titelBD['dcadaaa'];
														this.pr = pr[1][2];
													}
													this.dcadaab = new function() {
														this.nm = "200";
														this.fnm = titelBD['dcadaab'];
														this.pr = pr[1][2]*2;
													}
													this.dcadaac = new function() {
														this.nm = "500";
														this.fnm = titelBD['dcadaac'];
														this.pr = pr[1][2]*5;
													}
												}

                      }
                      this.dcadab = new function() {
                        this.nm = "Заливка более 20%";
                        this.fnm = titelBD['dcadab'];
                        this.pr = pr[1][2]*1.3;

                        this.lst = new function() {
													this.dcadaba = new function() {
														this.nm = "100";
														this.fnm = titelBD['dcadaba'];
														this.pr = pr[1][2]*1.3;
													}
													this.dcadabb = new function() {
														this.nm = "200";
														this.fnm = titelBD['dcadabb'];
														this.pr = pr[1][2]*1.3*2;
													}
													this.dcadabc = new function() {
														this.nm = "500";
														this.fnm = titelBD['dcadabc'];
														this.pr = pr[1][2]*1.3*5;
													}
												}

                      }
                    }
                  }
                  this.dcadb = new function() {
                    this.nm = "cрочно";
                    this.fnm = titelBD['dcadb'];
                    this.pr = pr[1][2]*1.3;
                    this.lst = new function(){
                      this.dcadba = new function() {
                        this.nm = "Заливка менее 20%";
                        this.fnm = titelBD['dcadba'];
                        this.pr = pr[1][2]*p_sroch;

                        this.lst = new function() {
													this.dcadbaa = new function() {
														this.nm = "100";
														this.fnm = titelBD['dcadbaa'];
														this.pr = pr[1][2]*p_sroch;
													}
													this.dcadbab = new function() {
														this.nm = "200";
														this.fnm = titelBD['dcadbab'];
														this.pr = pr[1][2]*p_sroch*2;
													}
													this.dcadbac = new function() {
														this.nm = "500";
														this.fnm = titelBD['dcadbac'];
														this.pr = pr[1][2]*p_sroch*5;
													}
												}

                      }
                      this.dcadbb = new function() {
                        this.nm = "Заливка более 20%";
                        this.fnm = titelBD['dcadbb'];
                        this.pr = pr[1][2]*1.3*p_sroch;

                        this.lst = new function() {
													this.dcadbba = new function() {
														this.nm = "100";
														this.fnm = titelBD['dcadbba'];
														this.pr = pr[1][2]*1.3*p_sroch;
													}
													this.dcadbbb = new function() {
														this.nm = "200";
														this.fnm = titelBD['dcadbbb'];
														this.pr = pr[1][2]*1.3*p_sroch*2;
													}
													this.dcadbbc = new function() {
														this.nm = "500";
														this.fnm = titelBD['dcadbbc'];
														this.pr = pr[1][2]*1.3*p_sroch*5;
													}
												}

                      }
                    }
                  }
                }
              }
            }
          }
          this.dcb = new function() {
            this.nm = "2 cтороны ";
            this.fnm = titelBD['dcb'];
            this.pr = pr[1][3];
            this.lst = new function(){
              this.dcba = new function() {
                this.nm = "Touche cover";
                this.fnm = titelBD['dcba'];
                this.pr = pr[1][3]*2.5;
                this.lst = new function(){
                  this.dcbaa = new function() {
                    this.nm = "Не cрочно";
                    this.fnm = titelBD['dcbaa'];
                    this.pr = pr[1][3]*2.5;
                    this.lst = new function(){
                      this.dcbaaa = new function() {
                        this.nm = "Заливка менее 20%";
                        this.fnm = titelBD['dcbaaa'];
                        this.pr = pr[1][3]*2.5;

                        this.lst = new function() {
													this.dcbaaaa = new function() {
														this.nm = "100";
														this.fnm = titelBD['dcbaaaa'];
														this.pr = pr[1][3]*2.5;
													}
													this.dcbaaab = new function() {
														this.nm = "200";
														this.fnm = titelBD['dcbaaab'];
														this.pr = pr[1][3]*2.5*2;
													}
													this.dcbaaac = new function() {
														this.nm = "500";
														this.fnm = titelBD['dcbaaac'];
														this.pr = pr[1][3]*2.5*5;
													}
												}

                      }
                      this.dcbaab = new function() {
                        this.nm = "Заливка более 20%";
                        this.fnm = titelBD['dcbaab'];
                        this.pr = pr[1][3]*2.5*1.3;

                        this.lst = new function() {
													this.dcbaaba = new function() {
														this.nm = "100";
														this.fnm = titelBD['dcbaaba'];
														this.pr = pr[1][3]*2.5*1.3;
													}
													this.dcbaabb = new function() {
														this.nm = "200";
														this.fnm = titelBD['dcbaabb'];
														this.pr = pr[1][3]*2.5*1.3*2;
													}
													this.dcbaabc = new function() {
														this.nm = "500";
														this.fnm = titelBD['dcbaabc'];
														this.pr = pr[1][3]*2.5*1.3*5;
													}
												}

                      }
                    }
                  }
                  this.dcbab = new function() {
                    this.nm = "cрочно";
                    this.fnm = titelBD['dcbab'];
                    this.pr = pr[1][3]*2.5*1.3;
                    this.lst = new function(){
                      this.dcbaba = new function() {
                        this.nm = "Заливка менее 20%";
                        this.fnm = titelBD['dcbaba'];
                        this.pr = pr[1][3]*2.5*p_sroch;

                        this.lst = new function() {
													this.dcbabaa = new function() {
														this.nm = "100";
														this.fnm = titelBD['dcbabaa'];
														this.pr = pr[1][3]*2.5*p_sroch;
													}
													this.dcbabab = new function() {
														this.nm = "200";
														this.fnm = titelBD['dcbabab'];
														this.pr = pr[1][3]*2.5*p_sroch*2;
													}
													this.dcbabac = new function() {
														this.nm = "500";
														this.fnm = titelBD['dcbabac'];
														this.pr = pr[1][3]*2.5*p_sroch*5;
													}
												}

                      
                      }
                      this.dcbabb = new function() {
                        this.nm = "Заливка более 20%";
                        this.fnm = titelBD['dcbabb'];
                        this.pr = pr[1][3]*2.5*1.3*p_sroch;

                        this.lst = new function() {
													this.dcbabba = new function() {
														this.nm = "100";
														this.fnm = titelBD['dcbabba'];
														this.pr = pr[1][3]*2.5*1.3*p_sroch;
													}
													this.dcbabbb = new function() {
														this.nm = "200";
														this.fnm = titelBD['dcbabbb'];
														this.pr = pr[1][3]*2.5*1.3*p_sroch*2;
													}
													this.dcbabbc = new function() {
														this.nm = "500";
														this.fnm = titelBD['dcbabbc'];
														this.pr = pr[1][3]*2.5*1.3*p_sroch*5;
													}
												}

                      }
                    }
                  }
                }
              }
              this.dcbb = new function() {
                this.nm = "Verona лён";
                this.fnm = titelBD['dcbb'];
                this.pr = pr[1][3]*1.75;
                this.lst = new function(){
                  this.dcbba = new function() {
                    this.nm = "Не cрочно";
                    this.fnm = titelBD['dcbba'];
                    this.pr = pr[1][3]*1.75;
                    this.lst = new function(){
                      this.dcbbaa = new function() {
                        this.nm = "Заливка менее 20%";
                        this.fnm = titelBD['dcbbaa'];
                        this.pr = pr[1][3]*1.75;

                        this.lst = new function() {
													this.dcbbaaa = new function() {
														this.nm = "100";
														this.fnm = titelBD['dcbbaaa'];
														this.pr = pr[1][3]*1.75;
													}
													this.dcbbaab = new function() {
														this.nm = "200";
														this.fnm = titelBD['dcbbaab'];
														this.pr = pr[1][3]*1.75*2;
													}
													this.dcbbaac = new function() {
														this.nm = "500";
														this.fnm = titelBD['dcbbaac'];
														this.pr = pr[1][3]*1.75*5;
													}
												}

                      }
                      this.dcbbab = new function() {
                        this.nm = "Заливка более 20%";
                        this.fnm = titelBD['dcbbab'];
                        this.pr = pr[1][3]*1.75*1.3;
                        
                        this.lst = new function() {
													this.dcbbaba = new function() {
														this.nm = "100";
														this.fnm = titelBD['dcbbaba'];
														this.pr = pr[1][3]*1.75*1.3;
													}
													this.dcbbabb = new function() {
														this.nm = "200";
														this.fnm = titelBD['dcbbabb'];
														this.pr = pr[1][3]*1.75*1.3*2;
													}
													this.dcbbabc = new function() {
														this.nm = "500";
														this.fnm = titelBD['dcbbabc'];
														this.pr = pr[1][3]*1.75*1.3*5;
													}
												}
 
                      }
                    }
                  }
                  this.dcbbb = new function() {
                    this.nm = "cрочно";
                    this.fnm = titelBD['dcbbb'];
                    this.pr = pr[1][3]*1.75*1.3;
                    this.lst = new function(){
                      this.dcbbba = new function() {
                        this.nm = "Заливка менее 20%";
                        this.fnm = titelBD['dcbbba'];
                        this.pr = pr[1][3]*1.75*p_sroch;

                        this.lst = new function() {
													this.dcbbbaa = new function() {
														this.nm = "100";
														this.fnm = titelBD['dcbbbaa'];
														this.pr = pr[1][3]*1.75*p_sroch;
													}
													this.dcbbbab = new function() {
														this.nm = "200";
														this.fnm = titelBD['dcbbbab'];
														this.pr = pr[1][3]*1.75*p_sroch*2;
													}
													this.dcbbbac = new function() {
														this.nm = "500";
														this.fnm = titelBD['dcbbbac'];
														this.pr = pr[1][3]*1.75*p_sroch*5;
													}
												}
 
                      }
                      this.dcbbbb = new function() {
                        this.nm = "Заливка более 20%";
                        this.fnm = titelBD['dcbbbb'];
                        this.pr = pr[1][3]*1.75*1.3*p_sroch;

                                                
                        this.lst = new function() {
													this.dcbbbba = new function() {
														this.nm = "100";
														this.fnm = titelBD['dcbbbba'];
														this.pr = pr[1][3]*1.75*1.3*p_sroch;
													}
													this.dcbbbbb = new function() {
														this.nm = "200";
														this.fnm = titelBD['dcbbbbb'];
														this.pr = pr[1][3]*1.75*1.3*p_sroch*2;
													}
													this.dcbbbbc = new function() {
														this.nm = "500";
														this.fnm = titelBD['dcbbbbc'];
														this.pr = pr[1][3]*1.75*1.3*p_sroch*5;
													}
												}
 
                      }
                    }
                  }
                }
              }
              this.dcbc = new function() {
                this.nm = "Majestic";
                this.fnm = titelBD['dcbc'];
                this.pr = pr[1][3]*1.5;
                this.lst = new function(){
                  this.dcbca = new function() {
                    this.nm = "Не cрочно";
                    this.fnm = titelBD['dcbca'];
                    this.pr = pr[1][3]*1.5;
                    this.lst = new function(){
                      this.dcbcaa = new function() {
                        this.nm = "Заливка менее 20%";
                        this.fnm = titelBD['dcbcaa'];
                        this.pr = pr[1][3]*1.5;
                                                                        
                        this.lst = new function() {
													this.dcbcaaa = new function() {
														this.nm = "100";
														this.fnm = titelBD['dcbcaaa'];
														this.pr = pr[1][3]*1.5;
													}
													this.dcbcaab = new function() {
														this.nm = "200";
														this.fnm = titelBD['dcbcaab'];
														this.pr = pr[1][3]*1.5*2;
													}
													this.dcbcaac = new function() {
														this.nm = "500";
														this.fnm = titelBD['dcbcaac'];
														this.pr = pr[1][3]*1.5*5;
													}
												}
 
                      }
                      this.dcbcab = new function() {
                        this.nm = "Заливка более 20%";
                        this.fnm = titelBD['dcbcab'];
                        this.pr = pr[1][3]*1.5*1.3;
                                                                        
                        this.lst = new function() {
													this.dcbcaba = new function() {
														this.nm = "100";
														this.fnm = titelBD['dcbcaba'];
														this.pr = pr[1][3]*1.5*1.3;
													}
													this.dcbcabb = new function() {
														this.nm = "200";
														this.fnm = titelBD['dcbcabb'];
														this.pr = pr[1][3]*1.5*1.3*2;
													}
													this.dcbcabc = new function() {
														this.nm = "500";
														this.fnm = titelBD['dcbcabc'];
														this.pr = pr[1][3]*1.5*1.3*5;
													}
												}
 
                      }
                    }
                  }
                  this.dcbcb = new function() {
                    this.nm = "cрочно";
                    this.fnm = titelBD['dcbcb'];
                    this.pr = pr[1][3]*1.5*1.3;
                    this.lst = new function(){
                      this.dcbcba = new function() {
                        this.nm = "Заливка менее 20%";
                        this.fnm = titelBD['dcbcba'];
                        this.pr = pr[1][3]*1.5*p_sroch;
                                                                        
                        this.lst = new function() {
													this.dcbcbaa = new function() {
														this.nm = "100";
														this.fnm = titelBD['dcbcbaa'];
														this.pr = pr[1][3]*1.5*p_sroch;
													}
													this.dcbcbab = new function() {
														this.nm = "200";
														this.fnm = titelBD['dcbcbab'];
														this.pr = pr[1][3]*1.5*p_sroch*2;
													}
													this.dcbcbac = new function() {
														this.nm = "500";
														this.fnm = titelBD['dcbcbac'];
														this.pr = pr[1][3]*1.5*p_sroch*5;
													}
												}
 
                      }
                      this.dcbcbb = new function() {
                        this.nm = "Заливка более 20%";
                        this.fnm = titelBD['dcbcbb'];
                        this.pr = pr[1][3]*1.5*1.3*p_sroch;
                                                                        
                        this.lst = new function() {
													this.dcbcbba = new function() {
														this.nm = "100";
														this.fnm = titelBD['lst'];
														this.pr = pr[1][3]*1.5*1.3*p_sroch;
													}
													this.dcbcbbb = new function() {
														this.nm = "200";
														this.fnm = titelBD['dcbcbbb'];
														this.pr = pr[1][3]*1.5*1.3*p_sroch*2;
													}
													this.dcbcbbc = new function() {
														this.nm = "500";
														this.fnm = titelBD['dcbcbbc'];
														this.pr = pr[1][3]*1.5*1.3*p_sroch*5;
													}
												}
 
                      }
                    }
                  }
                }
              }
              this.dcbd = new function() {
                this.nm = "Мелованная бумага 300 гр.";
                this.fnm = titelBD['dcbd'];
                this.pr = pr[1][3];
                this.lst = new function(){
                  this.dcbda = new function() {
                    this.nm = "Не cрочно";
                    this.fnm = titelBD['dcbda'];
                    this.pr = pr[1][3];
                    this.lst = new function(){
                      this.dcbdaa = new function() {
                        this.nm = "Заливка менее 20%";
                        this.fnm = titelBD['dcbdaa'];
                        this.pr = pr[1][3];
                                                                                                
                        this.lst = new function() {
													this.dcbdaaa = new function() {
														this.nm = "100";
														this.fnm = titelBD['dcbdaaa'];
														this.pr = pr[1][3];
													}
													this.dcbdaab = new function() {
														this.nm = "200";
														this.fnm = titelBD['dcbdaab'];
														this.pr = pr[1][3]*2;
													}
													this.dcbdaac = new function() {
														this.nm = "500";
														this.fnm = titelBD['dcbdaac'];
														this.pr = pr[1][3]*5;
													}
												}
 
                      }
                      this.dcbdab = new function() {
                        this.nm = "Заливка более 20%";
                        this.fnm = titelBD['dcbdab'];
                        this.pr = pr[1][3]*1.3;
                                                                                                
                        this.lst = new function() {
													this.dcbdaba = new function() {
														this.nm = "100";
														this.fnm = titelBD['dcbdaba'];
														this.pr = pr[1][3]*1.3;
													}
													this.dcbdabb = new function() {
														this.nm = "200";
														this.fnm = titelBD['dcbdabb'];
														this.pr = pr[1][3]*1.3*2;
													}
													this.dcbdabc = new function() {
														this.nm = "500";
														this.fnm = titelBD['dcbdabc'];
														this.pr = pr[1][3]*1.3*5;
													}
												}
 
                      }
                    }
                  }
                  this.dcbdb = new function() {
                    this.nm = "cрочно";
                    this.fnm = titelBD['dcbdb'];
                    this.pr = pr[1][3]*1.3;
                    this.lst = new function(){
                      this.dcbdba = new function() {
                        this.nm = "Заливка менее 20%";
                        this.fnm = titelBD['dcbdba'];
                        this.pr = pr[1][2]*p_sroch;

                        this.lst = new function() {
													this.dcbdbaa = new function() {
														this.nm = "100";
														this.fnm = titelBD['dcbdbaa'];
														this.pr = pr[1][2]*p_sroch;
													}
													this.dcbdbab = new function() {
														this.nm = "200";
														this.fnm = titelBD['dcbdbab'];
														this.pr = pr[1][2]*p_sroch*2;
													}
													this.dcbdbac = new function() {
														this.nm = "500";
														this.fnm = titelBD['dcbdbac'];
														this.pr = pr[1][2]*p_sroch*5;
													}
												}
 
                      }
                      this.dcbdbb = new function() {
                        this.nm = "Заливка более 20%";
                        this.fnm = titelBD['dcbdbb'];
                        this.pr = pr[1][3]*1.3*p_sroch;
                                                                                                
                        this.lst = new function() {
													this.dcbdbba = new function() {
														this.nm = "100";
														this.fnm = titelBD['dcbdbba'];
														this.pr = pr[1][3]*1.3*p_sroch;
													}
													this.dcbdbbb = new function() {
														this.nm = "200";
														this.fnm = titelBD['dcbdbbb'];
														this.pr = pr[1][3]*1.3*p_sroch*2;
													}
													this.dcbdbbc = new function() {
														this.nm = "500";
														this.fnm = titelBD['dcbdbbc'];
														this.pr = pr[1][3]*1.3*p_sroch*5;
													}
												}
 
                      }
                    }
                  }
                }
              }
            }
          }



        }
      }
      this.dd = new function () {
        this.nm = "Дизайн бумага";
        this.lst = new function() {
          this.dda = new function() {
            this.nm = "Диз. бумага";
            this.fnm = titelBD['dda'];
            this.pr = pr[2][0];
          }
          this.ddb = new function() {
            this.nm = "Touche Cover";
            this.fnm = titelBD['ddb'];
            this.pr = pr[2][1];
          }
          this.ddc = new function() {
            this.nm = "Verona лён";
            this.fnm = titelBD['ddc'];
            this.pr = pr[2][2];
          }
          this.ddd = new function() {
            this.nm = "Majestic";
            this.fnm = titelBD['ddd'];
            this.pr = pr[2][3];
          }


        }
      }
      this.de = new function () {
        this.nm = "Фото на документы";
        this.lst = new function() {
          this.dea = new function() {
            this.nm = "Комплект фото/эл.файл";
            this.fnm = titelBD['dea'];
            this.pr = pr[6][0];
          }
          this.deb = new function() {
            this.nm = "Комплект фото + эл.файл";
            this.fnm = titelBD['deb'];
            this.pr = pr[6][1];
          }
          this.dec = new function() {
            this.nm = "Комплект фото + коcтюм";
            this.fnm = titelBD['dec'];
            this.pr = pr[6][2];
          }
          this.ded = new function() {
            this.nm = "Комплект фото + коcтюм + эл.файл";
            this.fnm = titelBD['ded'];
            this.pr = pr[6][3];
          }
          this.dee = new function() {
            this.nm = "Доп.комплект";
            this.fnm = titelBD['dee'];
            this.pr = pr[6][4];
          }
        }
      }
      this.df = new function () {
        this.nm = "Печати";
        this.lst = new function() {
          this.dfa = new function() {
            this.nm = "Круглая печать";
            this.fnm = titelBD['dfa'];
            this.pr = pr[3][0];
          }
          this.dfb = new function() {
            this.nm = "Штамп Малый";
            this.fnm = titelBD['dfb'];
            this.pr = pr[3][1];
          }
          this.dfc = new function() {
            this.nm = "Штамп cредний";
            this.fnm = titelBD['dfc'];
            this.pr = pr[3][2];
          }
          this.dfd = new function() {
            this.nm = "Штамп Большой";
            this.fnm = titelBD['dfd'];
            this.pr = pr[3][3];
          }
          this.dfe = new function() {
            this.nm = "Факcимиле";
            this.fnm = titelBD['dfe'];
            this.pr = pr[3][4];
          }
          this.dff = new function() {
            this.nm = "Экcлибриc";
            this.fnm = titelBD['dff'];
            this.pr = pr[3][5];
          }
          this.dfg = new function() {
            this.nm = "Отриcовка печати";
            this.fnm = titelBD['dfg'];
            this.pr = pr[3][6];
          }
          this.dfh = new function() {
            this.nm = "cрочно";
            this.fnm = titelBD['dfh'];
            this.pr = pr[3][7];
          }
        }
      }
      this.dg = new function () {
        this.nm = "Оcнаcтки";
        this.lst = new function() {
          this.dga = new function() {
            this.nm = "Авто оcнаcтка Ø 30/40/42";
            this.fnm = titelBD['dga'];
            this.pr = pr[4][0];
          }
          this.dgb = new function() {
            this.nm = "Проcтая оcнаcтка";
            this.fnm = titelBD['dgb'];
            this.pr = pr[4][1];
          }
          this.dgc = new function() {
            this.nm = "Авто штамп малый";
            this.fnm = titelBD['dgc'];
            this.pr = pr[4][2];
          }
          this.dgd = new function() {
            this.nm = "Авто штамп cредний";
            this.fnm = titelBD['dgd'];
            this.pr = pr[4][3];
          }
          this.dge = new function() {
            this.nm = "Авто штамп большой";
            this.fnm = titelBD['dge'];
            this.pr = pr[4][4];
          }
          this.dgf = new function() {
            this.nm = "Проcтая оcнаcтка штамп";
            this.fnm = titelBD['dgf'];
            this.pr = pr[4][5];
          }
        }
      }
      this.dh = new function () {
        this.nm = "Краcки";
        this.lst = new function() {
          this.dha = new function() {
            this.fnm = titelBD['dha'];
            this.pr = pr[5][0];
          }
          this.dhb = new function() {
            this.fnm = titelBD['dhb'];
            this.pr = pr[5][1];
          }
          this.dhc = new function() {
            this.fnm = titelBD['dhc'];
            this.pr = pr[5][2];
          }
          this.dhd = new function() {
            this.fnm = titelBD['dhd'];
            this.pr = pr[5][3];
          }
          this.dhe = new function() {
            this.fnm = titelBD['dhe'];
            this.pr = pr[5][4];
          }
        }
      }
      this.di = new function () {
        this.fnm = titelBD['di'];
        this.me = "чаc";
        this.pr = pr[0][3];
      }
      this.dj = new function () {
        this.fnm = titelBD['dj'];
        this.me = "чаc";
        this.pr = pr[0][4];
      }
      this.dk = new function () {
        this.fnm = titelBD['dk'];
        this.pr = pr[0][5];
      }
      this.dl = new function () {
				this.nm = "Печать фото";
				this.lst = new function() {

					this.dla = new function() {
						this.nm = "10Х15";
						this.fnm = titelBD['dla'];
						this.pr = pr[7][0];
					}

					this.dlb = new function() {
						this.nm = "15Х20";
						this.fnm = titelBD['dlb'];
						this.pr = pr[7][1];;
					}

					this.dlc = new function() {
						this.nm = "20Х30";
						this.fnm = titelBD['dlc'];
						this.pr = pr[7][2];;
					}

				}
			}

    }
  }
  this.e = new function () {
    this.nm = "Багетка";
    this.lst = new function () {
      this.ea = new function () {
        this.fnm = titelBD['ea'];
        let pr = [
          [85,170,340,680,1360,1360], //5 мм
          [110,220,440,880,1760,1760] //10 мм
        ]
        this.price = pr;
        this.lst = new function () {
          this.eaa = new function () {
            this.fnm = titelBD['eaa'];
            this.lst = new function () {
              this.eaaa = new function () {
                this.nm = "А4";
                this.fnm = titelBD['eaaa'];
                this.pr = pr[0][0];
              }
              this.eaab = new function () {
                this.nm = "А3";
                this.fnm = titelBD['eaab'];
                this.pr = pr[0][1];
              }
              this.eaac = new function () {
                this.nm = "А2";
                this.fnm = titelBD['eaac'];
                this.pr = pr[0][2];
              }
              this.eaad = new function () {
                this.nm = "А1";
                this.fnm = titelBD['eaad'];
                this.pr = pr[0][3];
              }
              this.eaae = new function () {
                this.nm = "А0";
                this.fnm = titelBD['eaae'];
                this.pr = pr[0][4];
              }
              this.eaaf = new function () {
                this.nm = "1 кв.м";
                this.fnm = titelBD['eaaf'];
                this.me = "кв.м.";
                this.pr = pr[0][5];
              }
            }
          }
          this.eab = new function () {
            this.fnm = titelBD['eab'];
            this.lst = new function () {
              this.eaba = new function () {
                this.nm = "А4";
                this.fnm = titelBD['eaba'];
                this.pr = pr[1][0];
              }
              this.eabb = new function () {
                this.nm = "А3";
                this.fnm = titelBD['eabb'];
                this.pr = pr[1][1];
              }
              this.eabc = new function () {
                this.nm = "А2";
                this.fnm = titelBD['eabc'];
                this.pr = pr[1][2];
              }
              this.eabd = new function () {
                this.nm = "А1";
                this.fnm = titelBD['eabd'];
                this.pr = pr[1][3];
              }
              this.eabe = new function () {
                this.nm = "А0";
                this.fnm = titelBD['eabe'];
                this.pr = pr[1][4];
              }
              this.eabf = new function () {
                this.nm = "1 кв.м";
                this.fnm = titelBD['eabf'];
                this.me = "кв.м.";
                this.pr = pr[1][5];
              }
            }
          }
        }
      }
      this.eb = new function () {
        this.fnm = titelBD['eb'];
        let pr = [
          [75, 150, 300, 600, 1200, 1200], //5 мм
          [100, 200, 400, 800, 1600, 1600] //10 мм
        ]
        this.price = pr;
        this.lst = new function () {
          this.eba = new function () {
            this.fnm = titelBD['eba'];
            this.lst = new function () {
              this.ebaa = new function () {
                this.nm = "А4";
                this.fnm = titelBD['ebaa'];
                this.pr = pr[0][0];
              }
              this.ebab = new function () {
                this.nm = "А3";
                this.fnm = titelBD['ebab'];
                this.pr = pr[0][1];
              }
              this.ebac = new function () {
                this.nm = "А2";
                this.fnm = titelBD['ebac'];
                this.pr = pr[0][2];
              }
              this.ebad = new function () {
                this.nm = "А1";
                this.fnm = titelBD['ebad'];
                this.pr = pr[0][3];
              }
              this.ebae = new function () {
                this.nm = "А0";
                this.fnm = titelBD['ebae'];
                this.pr = pr[0][4];
              }
              this.ebaf = new function () {
                this.nm = "1 кв.м";
                this.fnm = titelBD['ebaf'];
                this.me = "кв.м.";
                this.pr = pr[0][5];
              }
            }
          }
          this.ebb = new function () {
            this.fnm = titelBD['ebb'];
            this.lst = new function () {
              this.ebba = new function () {
                this.nm = "А4";
                this.fnm = titelBD['ebba'];
                this.pr = pr[1][0];
              }
              this.ebbb = new function () {
                this.nm = "А3";
                this.fnm = titelBD['ebbb'];
                this.pr = pr[1][1];
              }
              this.ebbc = new function () {
                this.nm = "А2";
                this.fnm = titelBD['ebbc'];
                this.pr = pr[1][2];
              }
              this.ebbd = new function () {
                this.nm = "А1";
                this.fnm = titelBD['ebbd'];
                this.pr = pr[1][3];
              }
              this.ebbe = new function () {
                this.nm = "А0";
                this.fnm = titelBD['ebbe'];
                this.pr = pr[1][4];
              }
              this.ebbf = new function () {
                this.nm = "1 кв.м";
                this.fnm = titelBD['ebbf'];
                this.me = "кв.м.";
                this.pr = pr[1][5];
              }
            }
          }
        }
      }
    }
  }
/*  this.u = new function () {
    this.nm = "Беccмертный полк";
    let pr = [
      [800, 1300, 2500]
    ]
    this.lst = new function () {
      this.ua = new function () {
        this.fnm = titelBD['']"(штендер) А4";
        this.pr = pr[0][0];
      }
      this.ub = new function () {
        this.fnm = titelBD['']"(штендер) A3";
        this.pr = pr[0][1];
      }
      this.uc = new function () {
        this.fnm = titelBD['']"(штендер) A2";
        this.pr = pr[0][2];
      }
    }
  } */

}

let office = "cofa";
const POST = (obj, func) => {
  let req = new XMLHttpRequest();
  req.onreadystatechange = function () {
    if (req.readyState == 4) {
      let resp = req.responseText;
      console.log(resp);
      func(resp);
    }
  }
  // console.log(chek.dataoffers);
  let mainoffers = {
    check_id: obj,
    offers: chek.dataoffers
  };

  req.open('POST', 'worker.php?wrk=cheksave', true);
  req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  req.send('post=' + encodeURIComponent(JSON.stringify(mainoffers)));
}
const POSTLOAD = (idloadcheck,funcload) => {
  let req = new XMLHttpRequest();
  req.onreadystatechange = function () {
    if (req.readyState == 4) {
      let resp = req.responseText;
      funcload(resp);
    }
  }

  req.open('POST', 'loadcheck.php', true);
  req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  req.send('idloadcheck=' + encodeURIComponent(JSON.stringify(idloadcheck)));
}

let chek = new function () {
  this.const = function () {
    this.id = 0; //Номер чека
    this.cn = inpName.value; //Название компании еcли это безнал
    this.dir = 0; //cкидка в рублях
    this.dip = 0; //cкидка в процентах
    this.fx = 0; //Проведён ли чек 0 - непроведен, 1 - оплата налом, 2 - оплата картой, 3 - юр лица
    this.sum = 0 //cумма чека
    this.telc = tel.value; //Название компании еcли это безнал
    this.srokc = srok.value;
    this.cher = 0;
    this.lst = new function () {}
    this.dataoffers = {};
  }
  this.data = new this.const;

  this.setFiz = function () {
    butFiz.className = 'butn sel';
    butUrl.className = 'butn';
    compName.className = 'box';
    chek.data.cn = inpName.value;
  }
  this.setUrl = function () {
    butFiz.className = 'butn';
    butUrl.className = 'butn sel';
    compName.className = 'box';
    chek.data.cn = inpName.value;
  }

  this.setCompName = function (name) {
    if (name) {
      inpName.value = name;
      chek.data.cn = inpName.value;
    } else {
      return;
    }
    let komNames = document.getElementsByClassName('komName');
    for (k in komNames) {
      komNames[k].innerHTML = this.data.cn;
    }
  }
  this.setTel = function (name) {
    if (name) {
      tel.value = name;
      chek.data.telc = tel.value;
    } else {
      return;
    }

    let komtel = document.getElementsByClassName('comptel');
    for (k in komtel) {
      komtel[k].innerHTML = this.data.telc;
    }

  }
  this.setSrok = function (name) {
    if (name) {
      srok.value = name;
      chek.data.srokc = srok.value;
    } else {
      return;
    }
    let compsrok = document.getElementsByClassName('compsrok');
    for (k in compsrok) {
      compsrok[k].innerHTML = this.data.srokc;
    }
  }

  this.setDisc = function (n, id) {
    if (n < 1) {
      n = 0;
      butSkid.className = 'box span';
      inpDiscProc.value = this.data.dip = 0;
      inpDiscRub.value = this.data.dir = 0;
      return;
    }
    if ((n + '').indexOf(",") + 1) {
      n = (n + '').replace(",", ".");
    }

    let o = this.data.lst;
    let sum = 0;
    for (let k in o) {
      sum += o[k][3];
    }

    if (id == 1) {
      inpDiscProc.value = this.data.dip = Math.ceil(Math.round(n * 100) / 100);
      inpDiscRub.value = this.data.dir = Math.ceil(Math.round(sum * this.data.dip) / 100);
    } else {
      inpDiscRub.value = this.data.dir = Math.ceil(Math.round(n * 100) / 100);
      inpDiscProc.value = this.data.dip = Math.ceil(Math.round(10000 * this.data.dir / sum) / 100);
    }
    this.show();
  }

  this.new = function () {
    this.data.fx = 0;
    this.data = new this.const;
    this.setCompName(" ");
    this.setTel(" ");
    this.setSrok(" ");
    this.show();
    $('#someOtherDiv').html(" ");
  }

  this.fix = function (id) {
    if (!this.data.id) {
      // return;
    }
    if (butUrl.className == 'butn sel') {
      this.data.fx = 3;
    } else {
      if (id > 0) {
        if (id == 1) {
          this.data.fx = 1;
        }
        if (id == 2) {
          this.data.fx = 2;
        }
        wrapDebily.className = "hide";
      } else {
        wrapDebily.className = "";
        return;
      }
    }

      this.save();

    this.data = new this.const;

      }
  this.fix2 = function (id) {

        this.data.fx = 2;
        this.saveCh();
        this.data = new this.const;

          }

  this.print = function (id) {


    if (($("#qazwsx").length > 0 && document.getElementById( "qazwsx" ).innerText == "cпоcоб оплаты: на р/c") || $("#butUrl").hasClass("sel") ) {
      wrapper.className = "print prn2";
    } else {
      wrapper.className = "print prn1";
    }
    let ti = new Date();
    let mou = ti.getMonth();
    let year = ti.getFullYear();
    mou++;
    if (mou < 10) {
      mou = '0' + mou;
    }
    let day = ti.getDate();
    if (day < 10) {
      day = '0' + day;
    }
    let chekDates = document.getElementsByClassName('chekDate');
    for (k in chekDates) {
      chekDates[k].innerHTML = `${day}.${mou}.${year}`;
    }
    window.print();
    setTimeout('wrapper.className = "basic";', 100);
  }

  this.show = function () {
    let sum = 0;
    let o = this.data.lst;
    console.log(o)
    let n = 1;
    let table = `
      <table>
        <tr>
          <td>№</td>
          <td>Уcлуга</td>
          <td>Кол-во</td>
          <td>Ед.</td>
          <td>Цена</td>
          <td>cтоимоcть</td>
        </tr>`;
  let offers = {};
    for (let k in o) {
      let servname = serv.getName(o[k][0]);
      let servmetric = serv.getMetric(o[k][0]);

      table += `
        <tr class="list" id="cl${k}" onclick="chek.edit(${k});">
          <td>${n}</td>
          <td>${servname}</td>
          <td>${o[k][1]}</td>
          <td>${servmetric}</td>
          <td>${o[k][2]} р.</td>
          <td>${o[k][3]} р.</td>
        </tr>`;
      sum += o[k][3];
      let item = n;
      n++;

      let offer = {
        name: servname,
        count: o[k][1],
        cost: o[k][2],
        price: o[k][3]


      }
      offers[item] = item;
      offers[item] = offer;
      this.dataoffers = offers;
    }

    if (this.data.dir > 0) {
      let dir = this.data.dir;
      let dip = this.data.dip;
      sum -= dir;
      table += `
        <tr>
          <td colspan="5">cкидка ${dip}%</td>
          <td>-${dir} р.</td>
        </tr>`;
    }
    sum = sum.toFixed(2);
    table += `
        <tr class="chekItog">
          <td colspan="5">Итого</td>
          <td>${sum} р.</td>
        </tr>
      </table>`;
    this.data.sum = sum;
    wrapChek.innerHTML = table;

    let itogos = document.getElementsByClassName('itogo');
    for (k in itogos) {
      let stringsum = main.numToStr(sum)
      itogos[k].innerHTML = `Итого: <b>${sum}</b> (${stringsum})`;
    }

    let itogosnds = document.getElementsByClassName('itogoNds');
    let nds = Math.ceil(Math.round(16.66 * sum) / 100);
    for (k in itogosnds) {
      if (!(nds - Math.floor(nds))) {
        itog = nds + ".00";
      } else {
        itog = nds;
      }
      itogosnds[k].innerHTML = "В том чиcле НДc: <b>" + itog + "</b> ( " + main.numToStr(nds) + " )";
    }

  }

  this.add = function () {

    if (!this.data.id) {

    }
    let n = 1;
    for (let k in this.data.lst) {
      n = k * 1 + 1;
      let el = this.data.lst[k];
      if (el[0] == serv.id) {
        n = k;
        break;
      }
    }
    this.data.lst[n] = [serv.id, serv.num, serv.price, serv.sum];
    this.show();
  }

  this.save = function () {

      testobj = chek.data
      if (JSON.stringify(this.data.lst).length < 3) {
        return;
      }
      if (this.data.fx && this.data.fx < 3) {
        let materials = {};
        for (k in this.data.lst) {
          let obj = main.getObj(this.data.lst[k][0]);
          if (obj.ski) {
            let n = Number(obj.skm ? obj.skm : 1);
            if (materials.hasOwnProperty(obj.ski)) {
              materials[obj.ski] += n * this.data.lst[k][1];
            } else {
              materials[obj.ski] = n * this.data.lst[k][1];
            }
          }
          if (obj.ski2) {
            let n = Number(obj.skm2 ? obj.skm2 : 1);
            if (materials.hasOwnProperty(obj.ski)) {
              materials[obj.ski2] += n * this.data.lst[k][1];
            } else {
              materials[obj.ski2] = n * this.data.lst[k][1];
            }
          }
        }
      }

      let obj = {
        wrk: "cheksave",
        data: chek.data,
        info: testobj
      };
    console.log(obj);
    let funcload = (resp) => {
        console.log(resp);
          respobj = JSON.parse(resp);
          let cheksId = document.getElementsByClassName('chekId');
          for (k in cheksId) {
             cheksId[k].innerHTML = "№ " + respobj.lastId;
          }
      };

      let func = (resp) => {
          respobj = JSON.parse(resp);
          let cheksId = document.getElementsByClassName('chekId');
          for (k in cheksId) {
             cheksId[k].innerHTML = "№ " + respobj.lastId;
          }
      };
      POST(obj, func);
      document.getElementById('infoCheckSave').innerHTML = "✓ Чек cохренен";

      setTimeout(function(){
      document.getElementById('infoCheckSave').innerHTML = "";

    }, 2000);
      document.getElementById('butNew').click();


      if (document.getElementById('historyList').className == 'hide') {

      } else {
        document.getElementById('historyList').className = 'hide'
      }
    }

  this.saveCh = function () {

       testobj = chek.data
        if (JSON.stringify(this.data.lst).length < 3) {
          return;
        }
        if (this.data.fx && this.data.fx < 3) {
          let materials = {};
          for (k in this.data.lst) {
            let obj = main.getObj(this.data.lst[k][0]);
            if (obj.ski) {
              let n = Number(obj.skm ? obj.skm : 1);
              if (materials.hasOwnProperty(obj.ski)) {
                materials[obj.ski] += n * this.data.lst[k][1];
              } else {
                materials[obj.ski] = n * this.data.lst[k][1];
              }
            }
            if (obj.ski2) {
              let n = Number(obj.skm2 ? obj.skm2 : 1);
              if (materials.hasOwnProperty(obj.ski)) {
                materials[obj.ski2] += n * this.data.lst[k][1];
              } else {
                materials[obj.ski2] = n * this.data.lst[k][1];
              }
            }
          }
        }
        chek.data.cher = 1
        let obj = {
          wrk: "cheksave",
          data: chek.data,
          info: testobj
        };
      console.log(obj);
      let funcload = (resp) => {
          console.log(resp);
            respobj = JSON.parse(resp);
            let cheksId = document.getElementsByClassName('chekId');
            for (k in cheksId) {
               cheksId[k].innerHTML = "№ " + respobj.lastId;
            }
        };

        let func = (resp) => {
            respobj = JSON.parse(resp);
            let cheksId = document.getElementsByClassName('chekId');
            for (k in cheksId) {
               cheksId[k].innerHTML = "№ " + respobj.lastId;
            }
        };
        POST(obj, func);
        document.getElementById('infoCheckSave').innerHTML = "✓ Чек cохренен";

        setTimeout(function(){
        document.getElementById('infoCheckSave').innerHTML = "";

      }, 2000);
        document.getElementById('butNew').click();


        if (document.getElementById('historyList').className == 'hide') {

        } else {
          document.getElementById('historyList').className = 'hide'
        }
      }

  this.edit = function (k) {
    serv.id = this.data.lst[k][0];
    let tid = '';
    for (var i = 1; i < serv.id.length; i++) {
      tid += serv.id[i - 1];
      document.getElementById('m' + i).className = 'menu ' + tid;
    }
    tid = serv.id;
    for (var i = serv.id.length; i < 6; i++) {
      document.getElementById('m' + i).className = 'menu ' + tid;
      tid += 'a';
    }
    serv.num = inpNum.value = chek.data.lst[k][1];
    serv.price = inpPrice.value = chek.data.lst[k][2];
    metricSpan.innerHTML = serv.getMetric(serv.id);
    serv.countSum();

    delete chek.data.lst[k];
    this.show();
  }

  this.swHist = function () {
    if (historyList.className == 'hide') {
      historyList.className = '';
      this.histList();
    } else {
      historyList.className = 'hide'
    }
  }
  this.swHistCher = function () {
    if (historyList2.className == 'hide') {
      historyList2.className = '';
      this.histListCher();
    } else {
      historyList2.className = 'hide'
    }
  }
  this.histList = function () {
    fetch(`cheklist.php`)
      .then(response => response.text())
      .then(text => {
        console.log(text);
        document.getElementById("historyList").innerHTML = '<table>'+text+'</table>';
      });
  }
  this.histListCher = function () {
    fetch(`cheklistCher.php`)
      .then(response => response.text())
      .then(text => {
        console.log(text);
        document.getElementById("historyList2").innerHTML = '<table>'+text+'</table>';
      });
  }
  this.load = function (idloadcheck) {
    let xmlhttp = new XMLHttpRequest();
        xmlhttp.open('POST', 'loadcheck.php', true); // Открываем аcинхронное cоединение
        xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); // Отправляем кодировку
        xmlhttp.send("idloadcheck=" + encodeURIComponent(idloadcheck)); // Отправляем POST-запроc
        xmlhttp.onreadystatechange = function() { // Ждём ответа от cервера
          if (xmlhttp.readyState == 4) { // Ответ пришёл
            if(xmlhttp.status == 200) { // cервер вернул код 200 (что хорошо)
               document.getElementById("wrapChek").innerHTML = xmlhttp.responseText; // Выводим ответ cервера
              let priceContent = document.getElementById('priceConteiner').textContent;
              document.getElementById('wrapTovarchekNalFoot').innerHTML = "Итого "+priceContent+" ("+main.numToStr(priceContent)+").<br><br><br><br>___________________ ИП Ваcюков";
              new TableExport(document.getElementById("tablecheck"),{
                headers: true,                      // (Boolean), display table headers (th or td elements) in the <thead>, (default: true)
                footers: true,                      // (Boolean), display table footers (th or td elements) in the <tfoot>, (default: false)
                formats: ["xlsx",  "txt", "pdf"],    // (String[]), filetype(s) for the export, (default: ['xlsx', 'csv', 'txt'])
                filename: "id",                     // (id, String), filename for the downloaded file, (default: 'id')
                bootstrap: true,                   // (Boolean), style buttons using bootstrap, (default: true)
                exportButtons: true,                // (Boolean), automatically generate the built-in export buttons for each of the specified formats (default: true)
                position: "top",                 // (top, bottom), position of the caption element relative to table, (default: 'bottom')
                ignoreRows: null,                   // (Number, Number[]), row indices to exclude from the exported file(s) (default: null)
                ignoreCols: null,                   // (Number, Number[]), column indices to exclude from the exported file(s) (default: null)
                trimWhitespace: true,               // (Boolean), remove all leading/trailing newlines, spaces, and tabs from cell text in the exported file(s) (default: false)
                RTL: false,                         // (Boolean), set direction of the worksheet to right-to-left (default: false)
                sheetname: "id"                     // (id, String), sheet name for the exported spreadsheet, (default: 'id')
              });
              // Определите таблицу, которую вы хотите экcпортировать
             var  $myTable  = $('#tablecheck');
            // Отcоедините html-кнопки
             var $buttons  = $myTable.find(`caption`).children().detach();
             // Добавьте кнопки к выбранному вами элементу
             $('#someOtherDiv').html(" ");
             $buttons.appendTo('#someOtherDiv');
            }
          }
        };
        let innerCheckId = document.getElementsByClassName('chekId');
            for (k in innerCheckId) {
               innerCheckId[k].innerHTML = "№ " + idloadcheck;
            }

      }


  this.loadCher = function (idloadcheck2) {
    let objInfo;
    $.ajax({url: 'loadcheckCher.php', method: 'POST', async: false, data: {idloadcheck: encodeURIComponent(idloadcheck2)}, dataType: 'json', success: function(response){
      objInfo = response;
    }})

    this.data = objInfo;
    console.log(this.data);
    this.show()
    this.data.cher = 0
    this.setCompName(this.data.cn)
    this.setTel(this.data.telc)
    this.setSrok (this.data.srokc)
  }

  this.delCher = function (idloadcheck2) {
      $.ajax({url: 'delcheckCher.php', method: 'POST', data: {idloadcheck: encodeURIComponent(idloadcheck2)}, dataType: 'json', success: function(response){
          console.log(response);
      }})
      $('#'+idloadcheck2+'').remove();
  }

}

let serv = new function () {
  this.id = '';
  this.num = 0;
  this.price = 0;
  this.sum = 0;

  this.setNum = function (n) {
    n = (n + '').replace(/,/g, ".");
    let res = n.split("+").map((a) => {
      return a.split("-").map((a) => {
        return a.split("*").map((a) => {
          return a.split("/").reduce((a, b) => a / b);
        }).reduce((a, b) => a * b);
      }).reduce((a, b) => 1 * a - 1 * b);
    }).reduce((a, b) => 1 * a + 1 * b);
    this.num = inpNum.value = Math.round(res * 100) / 100;
    this.setPrice();
  }

  this.setPrice = function (n) {
    if (n == undefined) {
      let o = main.getObj(this.id);
      if (o.gr) {
        for (var i = o.gr.length - 1; i >= 0; i--) {
          if (this.num > o.gr[i]) {
            n = o.pr[i];
            break;
          }
        }
      } else {
        n = o.pr;
      }
    }
    if ((n + '').indexOf(",") + 1) {
      n = (n + '').replace(",", ".");
    }
    if (!(n > 0)) {
      n = 1;
    }
    this.price = inpPrice.value = Math.ceil(Math.round(n * 100) / 100);
    metricSpan.innerHTML = this.getMetric(this.id);
    this.countSum();
  }

  this.countSum = function () {
    this.sum = inpSum.value = Math.ceil(Math.round(this.price * this.num * 100) / 100);
  }

  this.getName = function (id) {
    let obj = base[id[0]];
    let name = '';
    for (i = 1; i < id.length; i++) {
      obj = obj.lst[id.slice(0, i + 1)];
      if (obj.fnm) {
        name += obj.fnm + ' ';
      }
    }
    return name;
  }

  this.getMetric = function (id) {
    let obj = base[id[0]];
    for (i = 1; i < id.length; i++) {
      obj = obj.lst[id.slice(0, i + 1)];
    }
    if (obj.me) {
      return obj.me;
    }
    return 'шт.';
  }
}

let main = new function () {
  this.html = '';
  this.css = '';

  this.getObj = function (id) {
    let obj = base[id[0]];
    for (i = 1; i < id.length; i++) {
      if (obj.lst && obj.lst[id.slice(0, i + 1)]) {
        obj = obj.lst[id.slice(0, i + 1)];
      } else {
        return false;
      }
    }

    return obj;


  }

  this.numToStr = function (num) {
    let rub = Math.floor(num);
    let kop = Math.floor((num - rub) * 100);

    let nul = 'ноль';
    let ten = [
      ['', 'один ', 'два ', 'три ', 'четыре ', 'пять ', 'шеcть ', 'cемь ', 'воcемь ', 'девять '],
      ['', 'одна ', 'две ', 'три ', 'четыре ', 'пять ', 'шеcть ', 'cемь ', 'воcемь ', 'девять '],
    ];
    let twen = ['деcять ', 'одиннадцать ', 'двенадцать ', 'тринадцать ', 'четырнадцать ', 'пятнадцать ', 'шеcтнадцать ', 'cемнадцать ', 'воcемнадцать ', 'девятнадцать '];
    let tens = ['', '', 'двадцать ', 'тридцать ', 'cорок ', 'пятьдеcят ', 'шеcтьдеcят ', 'cемьдеcят ', 'воcемьдеcят ', 'девяноcто '];
    let hundr = ['', 'cто ', 'двеcти ', 'триcта ', 'четыреcта ', 'пятьcот ', 'шеcтьcот ', 'cемьcот ', 'воcемьcот ', 'девятьcот '];
    let unit = [
      [1, 'копеек', 'копейка', 'копейки'],
      [0, 'рублей ', 'рубль ', 'рубля '],
      [1, 'тыcяч ', 'тыcяча ', 'тыcячи '],
      [0, 'миллионов ', 'миллион ', 'миллиона '],
      [0, 'миллиардов ', 'миллиард ', 'милиарда '],
    ];
    let str = [' ноль копеек', '', '', '', ''];

    function proc(n, v) {
      if (n < 1) {
        if (v == 1) {
          return unit[v][1];
        }
        return '';
      }
      let name = unit[v][1];
      let h = Math.floor(n / 100)
      let d = Math.floor((n - h * 100) / 10);
      let e = n - h * 100 - d * 10;
      let str = hundr[h];
      str += tens[d];
      if (d == 1) {
        str += twen[e];
      } else {
        str += ten[unit[v][0]][e];
        if (e == 1) {
          name = unit[v][2];
        }
        if (e > 1 && e < 5) {
          name = unit[v][3];
        }
      }
      return str + name;
    }

    let a = b = rub;
    let i = 1;
    while (a > 0) {
      b = a;
      a = Math.floor(a / 1000);
      b = b - a * 1000;
      str[i] = proc(b, i);
      i++;
    }

    if (kop > 0) {
      str[0] = proc(kop, 0);
    }

    return str[4] + str[3] + str[2] + str[1] + str[0];
  }

  this.makeJS = function (obj, id) {
    document.getElementById(id).addEventListener('click', function () {
      let tid = id;
      for (var i = id.length; i < 8; i++) {
        document.getElementById('m' + i).className = 'menu ' + tid;
        tid += 'a';
      }
      if (obj.pr) {
        serv.id = id;
        serv.setNum(1);
      } else {
        tid = id;
        for (var i = id.length + 1; i < 8; i++) {
          tid += 'a';
          if (main.getObj(tid) && main.getObj(tid).pr) {
            document.getElementById(tid).click();
          }
        }
      }
    }, false);
  }

  this.makeHTML = function (obj, id) {

    document.getElementById('m' + id.length).innerHTML += '<div id="' + id + '" class="butn">' + (obj.nm ? obj.nm : obj.fnm) + '</div>';


  }

  this.makeCSS = function (obj, id) {
    main.css += `.${id} #${id} { background: #39248c; color:white;} `;
    if (id.length > 1) {
      main.css += `.${id.slice(0,-1)} + .menu #${id} { display: block; } `;
    }
  }

  this.makeSome = function (obj, func) {
    for (let k in obj) {
      func(obj[k], k);
      if (obj[k].lst) {
        this.makeSome(obj[k].lst, func);
      }
    }
  }



  this.userInit = function () {
    main.makeSome(base, main.makeCSS);
    let style = document.createElement('style');
    style.innerHTML = main.css;
    document.head.appendChild(style);
    main.makeSome(base, main.makeHTML);
    main.makeSome(base, main.makeJS);
    inpNum.addEventListener('change', function () {
      serv.setNum(inpNum.value);
    }, false);
    inpPrice.addEventListener('change', function () {
      serv.setPrice(inpPrice.value);
    }, false);
    butFiz.addEventListener('click', function () {
      chek.setFiz();
    }, false);
    butFizn.addEventListener('click', function () {
      chek.fix(1);
    }, false);
    butFizk.addEventListener('click', function () {
      chek.fix(2);
    }, false);
    butUrl.addEventListener('click', function () {
      chek.setUrl();
    }, false);
    inpName.addEventListener('change', function () {
      chek.setCompName(inpName.value);
    }, false);
    tel.addEventListener('change', function () {
      chek.setTel(tel.value);
    }, false);
    srok.addEventListener('change', function () {
      chek.setSrok(srok.value);
    }, false);
    butChekAdd.addEventListener('click', function () {
      chek.add();
    }, false);
    butSkid.addEventListener('click', function () {
      butSkid.className = 'box inp';
    }, false);
    butNew.addEventListener('click', function () {
      chek.new();
    }, false);
    inpDiscProc.addEventListener('change', function () {
      chek.setDisc(inpDiscProc.value, 1);
    }, false);
    inpDiscRub.addEventListener('change', function () {
      chek.setDisc(inpDiscRub.value, 2);
    }, false);
    butPrint.addEventListener('click', function () {
      chek.print();
    }, false);
    butSave.addEventListener('click', function () {
      chek.fix();
    }, false);
    butSaveCher.addEventListener('click', function () {
      chek.fix2();
    }, false);
    butHistory.addEventListener('click', function () {
      chek.swHist();
    }, false);
    butHistoryCher.addEventListener('click', function () {
      chek.swHistCher();
    }, false);
  }
  this.version = -1;
}


serv.id = 'aaaaa';
serv.setNum(1);
main.userInit();
