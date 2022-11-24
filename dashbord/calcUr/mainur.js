




let base = new function () {
  let z = 165; //глобальный коэф в процентах

  	this.a = new function () {
		this.nm = "Печать";
		let bA4 = [7.92,7.92,10.56,13.2,18.48,13.2,15.84,47.52,31.68]; // бумага: мт120, мт160, мт200, мт250, мт300, гл170, гл250, клк250, самоклейка
		for (k in bA4) { bA4[k] = Math.round(bA4[k]*z)/100; }
		this.bA4 = bA4;

		let bA3 = [15.84,21.12,26.4,31.68,26.4,62.04,92.4]; // бумага: мт160, мт200, мт250, мт280, гл170 , гл250, клк250
		for (k in bA3) { bA3[k] = Math.round(bA3[k]*z)/100; }
		this.bA3 = bA3;

		let cp = this.cp = Math.round(6*z)/100; // наценка за копирование со стекла

		this.lst = new function () {
			this.aa = new function () {
				this.nm = "цветная";
				this.fnm = "Цветная печать";
				let grS = [0,10000000,10000000,10000000,10000000,10000000,10000000,10000000];
				this.gradS = grS;
				let prS = [
					[9.60,9.60,9.60,9.60,9.60,9.60,9.60,9.60], // A4 односторон
					[19.2,19.2,19.2,19.2,19.2,19.2,19.2,19.2], // A4 двусторонн
					[19.2,19.2,19.2,19.2,19.2,19.2,19.2,19.2], // A3 односторон
					[38.4,38.4,38.4,38.4,38.4,38.4,38.4,38.4] // A3 двусторонн
				];
				for (k in prS) {
					for (l in prS[k]) {
						prS[k][l] = Math.round(prS[k][l]*z)/100;
					}
				}
				this.priceS = prS;
				let grL = [0,10000000,10000000,10000000];
				this.gradL = grL;
				let prL = [
					[42,42,42,42], //A2 обычная бумага заливка менее 20%
					[84,84,84,84], //A2 обычная бумага заливка более 20%
					[60,60,60,60], //A1 обычная бумага заливка менее 20%
					[120,120,120,120], //A1 обычная бумага заливка более 20%
					[144,144,144,144], //A0 обычная бумага заливка менее 20%
					[288,288,288,288], //A0 обычная бумага заливка более 20%
					[140.666,140.666,140.666,140.666], //Нестнд обычная бумага заливка менее 20%
					[288,288,288,288] //Нестнд обычная бумага заливка более 20%
				];
				for (k in prL) {
					for (l in prL[k]) {
						prL[k][l] = Math.round(prL[k][l]*z)/100;
					}
				}
				this.priceL = prL;
				let prU = [
					[360,492,252,660,960], //A2 матовая 180г, глянец HP, калька 90г, самоклейка, холст 320г
					[492,840,360,780,1440], //A1
					[984,1560,720,1440,2880], //A0
					[984,1560,720,1440,2880] //нест
				]
				for (k in prU) {
					for (l in prU[k]) {
						prU[k][l] = Math.round(prU[k][l]*z)/100;
					}
				}
				this.priceU = prU;
				this.lst = new function () {
					this.aaa = new function () {
						this.nm = "А4";
						this.fnm = "формат А4";
						this.lst = new function () {
							this.aaaa = new function () {
								this.nm = "обычная 80г";
								this.fnm = "обычная бумага 80 гр.";
								this.lst = new function () {
									this.aaaaa = new function () {
										this.nm = "односторонняя печать";
										this.ski = "b1";
										this.gr = grS;
										this.pr = prS[0].slice(0);
									}
									this.aaaab = new function () {
										this.fnm = "двусторонняя печать";
										this.ski = "b1";
										this.gr = grS;
										this.pr = prS[1].slice(0);
									}
									this.aaaac = new function () {
										this.fnm = "одностороннее копирование со стекла";
										this.ski = "b1";
										this.gr = grS;
										this.pr = prS[0].slice(0);
										for (k in this.pr) { this.pr[k] += cp; }
									}
									this.aaaad = new function () {
										this.fnm = "двустороннее копирование со стекла";
										this.ski = "b1";
										this.gr = grS;
										this.pr = prS[1].slice(0);
										for (k in this.pr) { this.pr[k] += cp; }
									}
								}
							}
							this.aaab = new function () {
								this.nm = "матовая 120г";
								this.fnm = "матовая бумага 120 гр.";
								this.lst = new function () {
									this.aaaba = new function () {
										this.nm = "односторонняя печать";
										this.ski = "b2";
										this.gr = grS;
										this.pr = prS[0].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[0]; }
									}
									this.aaabb = new function () {
										this.fnm = "двусторонняя печать";
										this.ski = "b2";
										this.gr = grS;
										this.pr = prS[1].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[0]; }
									}
									this.aaabс = new function () {
										this.fnm = "одностороннее копирование со стекла";
										this.ski = "b2";
										this.gr = grS;
										this.pr = prS[0].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[0] + cp; }
									}
									this.aaabd = new function () {
										this.fnm = "двустороннее копирование со стекла";
										this.ski = "b2";
										this.gr = grS;
										this.pr = prS[1].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[0] + cp; }
									}
								}
							}
							this.aaac = new function () {
								this.nm = "матовая 160г";
								this.fnm = "матовая бумага 160 гр.";
								this.lst = new function () {
									this.aaaca = new function () {
										this.nm = "односторонняя печать";
										this.ski = "b3";
										this.gr = grS;
										this.pr = prS[0].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[1]; }
									}
									this.aaacb = new function () {
										this.fnm = "двусторонняя печать";
										this.ski = "b3";
										this.gr = grS;
										this.pr = prS[1].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[1]; }
									}
									this.aaacс = new function () {
										this.fnm = "одностороннее копирование со стекла";
										this.ski = "b3";
										this.gr = grS;
										this.pr = prS[0].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[1] + cp; }
									}
									this.aaacd = new function () {
										this.fnm = "двустороннее копирование со стекла";
										this.ski = "b3";
										this.gr = grS;
										this.pr = prS[1].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[1] + cp; }
									}
								}
							}
							this.aaad = new function () {
								this.nm = "матовая 200г";
								this.fnm = "матовая бумага 200 гр.";
								this.lst = new function () {
									this.aaada = new function () {
										this.nm = "односторонняя печать";
										this.ski = "b4";
										this.gr = grS;
										this.pr = prS[0].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[2]; }
									}
									this.aaadb = new function () {
										this.fnm = "двусторонняя печать";
										this.ski = "b4";
										this.gr = grS;
										this.pr = prS[1].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[2]; }
									}
									this.aaadc = new function () {
										this.fnm = "одностороннее копирование со стекла";
										this.ski = "b4";
										this.gr = grS;
										this.pr = prS[0].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[2] + cp; }
									}
									this.aaadd = new function () {
										this.fnm = "двустороннее копирование со стекла";
										this.ski = "b4";
										this.gr = grS;
										this.pr = prS[1].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[2] + cp; }
									}
								}
							}
							this.aaae = new function () {
								this.nm = "матовая 250г";
								this.fnm = "матовая бумага 250 гр.";
								this.lst = new function () {
									this.aaaea = new function () {
										this.nm = "односторонняя печать";
										this.ski = "b5";
										this.gr = grS;
										this.pr = prS[0].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[3]; }
									}
									this.aaaeb = new function () {
										this.fnm = "двусторонняя печать";
										this.ski = "b5";
										this.gr = grS;
										this.pr = prS[1].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[3]; }
									}
									this.aaaec = new function () {
										this.fnm = "одностороннее копирование со стекла";
										this.ski = "b5";
										this.gr = grS;
										this.pr = prS[0].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[3] + cp; }
									}
									this.aaaed = new function () {
										this.fnm = "двустороннее копирование со стекла";
										this.ski = "b5";
										this.gr = grS;
										this.pr = prS[1].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[3] + cp; }
									}
								}
							}
							this.aaaf = new function () {
								this.nm = "матовая 300г";
								this.fnm = "матовая бумага 300 гр.";
								this.lst = new function () {
									this.aaafa = new function () {
										this.nm = "односторонняя печать";
										this.ski = "b6";
										this.gr = grS;
										this.pr = prS[0].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[4]; }
									}
									this.aaafb = new function () {
										this.fnm = "двусторонняя печать";
										this.ski = "b6";
										this.gr = grS;
										this.pr = prS[1].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[4]; }
									}
									this.aaafc = new function () {
										this.fnm = "одностороннее копирование со стекла";
										this.ski = "b6";
										this.gr = grS;
										this.pr = prS[0].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[4] + cp; }
									}
									this.aaafd = new function () {
										this.fnm = "двустороннее копирование со стекла";
										this.ski = "b6";
										this.gr = grS;
										this.pr = prS[1].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[4] + cp; }
									}
								}
							}
							this.aaag = new function () {
								this.nm = "глянец 170г";
								this.fnm = "глянцевая бумага 170 гр.";
								this.lst = new function () {
									this.aaaga = new function () {
										this.nm = "односторонняя печать";
										this.ski = "b7";
										this.gr = grS;
										this.pr = prS[0].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[5]; }
									}
									this.aaagb = new function () {
										this.fnm = "двусторонняя печать";
										this.ski = "b7";
										this.gr = grS;
										this.pr = prS[1].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[5]; }
									}
									this.aaagc = new function () {
										this.fnm = "одностороннее копирование со стекла";
										this.ski = "b7";
										this.gr = grS;
										this.pr = prS[0].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[5] + cp; }
									}
									this.aaagd = new function () {
										this.fnm = "двустороннее копирование со стекла";
										this.ski = "b7";
										this.gr = grS;
										this.pr = prS[1].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[5] + cp; }
									}
								}
							}
							this.aaah = new function () {
								this.nm = "глянец 250г";
								this.fnm = "глянцевая бумага 250 гр.";
								this.lst = new function () {
									this.aaaha = new function () {
										this.nm = "односторонняя печать";
										this.ski = "b8";
										this.gr = grS;
										this.pr = prS[0].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[6]; }
									}
									this.aaahb = new function () {
										this.fnm = "двусторонняя печать";
										this.ski = "b8";
										this.gr = grS;
										this.pr = prS[1].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[6]; }
									}
									this.aaahc = new function () {
										this.fnm = "одностороннее копирование со стекла";
										this.ski = "b8";
										this.gr = grS;
										this.pr = prS[0].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[6] + cp; }
									}
									this.aaahd = new function () {
										this.fnm = "двустороннее копирование со стекла";
										this.ski = "b8";
										this.gr = grS;
										this.pr = prS[1].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[6] + cp; }
									}
								}
							}
							this.aaaj = new function () {
								this.nm = "калька 250г";
								this.fnm = "калька 250 гр.";
								this.lst = new function () {
									this.aaaja = new function () {
										this.nm = "односторонняя печать";
										this.ski = "b4k";
										this.gr = grS;
										this.pr = prS[0].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[7]; }
									}
									this.aaajb = new function () {
										this.fnm = "двусторонняя печать";
										this.ski = "b4k";
										this.gr = grS;
										this.pr = prS[1].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[7]; }
									}
									this.aaajc = new function () {
										this.fnm = "одностороннее копирование со стекла";
										this.ski = "b4k";
										this.gr = grS;
										this.pr = prS[0].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[7] + cp; }
									}
									this.aaajd = new function () {
										this.fnm = "двустороннее копирование со стекла";
										this.ski = "b4k";
										this.gr = grS;
										this.pr = prS[1].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[7] + cp; }
									}
								}
							}
							this.aaai = new function () {
								this.nm = "самоклейка";
								this.fnm = "самоклейка";
								this.ski = "b9";
								this.gr = grS;
								this.pr = prS[0].slice(0);
								for (k in this.pr) { this.pr[k] += bA4[7]; }
							}
						}
					}
					this.aab = new function () {
						this.nm = "А3";
						this.fnm = "формат А3";
						this.lst = new function () {
							this.aaba = new function () {
								this.nm = "обычная 80г";
								this.fnm = "обычная бумага 80 гр.";
								this.lst = new function () {
									this.aabaa = new function () {
										this.nm = "односторонняя печать";
										this.ski = "b10";
										this.gr = grS;
										this.pr = prS[2].slice(0);
									}
									this.aabab = new function () {
										this.fnm = "двусторонняя печать";
										this.ski = "b10";
										this.gr = grS;
										this.pr = prS[3].slice(0);
									}
									this.aabac = new function () {
										this.fnm = "одностороннее копирование со стекла";
										this.ski = "b10";
										this.gr = grS;
										this.pr = prS[2].slice(0);
										for (k in this.pr) { this.pr[k] += cp; }
									}
									this.aabad = new function () {
										this.fnm = "двустороннее копирование со стекла";
										this.ski = "b10";
										this.gr = grS;
										this.pr = prS[3].slice(0);
										for (k in this.pr) { this.pr[k] += cp; }
									}
								}
							}
							this.aabb = new function () {
								this.nm = "матовая 160г";
								this.fnm = "матовая бумага 160 гр.";
								this.lst = new function () {
									this.aabba = new function () {
										this.nm = "односторонняя печать";
										this.ski = "b11";
										this.gr = grS;
										this.pr = prS[2].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[0]; }
									}
									this.aabbb = new function () {
										this.fnm = "двусторонняя печать";
										this.ski = "b11";
										this.gr = grS;
										this.pr = prS[3].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[0]; }
									}
									this.aabbc = new function () {
										this.fnm = "одностороннее копирование со стекла";
										this.ski = "b11";
										this.gr = grS;
										this.pr = prS[2].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[0] + cp; }
									}
									this.aabbd = new function () {
										this.fnm = "двустороннее копирование со стекла";
										this.ski = "b11";
										this.gr = grS;
										this.pr = prS[3].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[0] + cp; }
									}
								}
							}
							this.aabc = new function () {
								this.nm = "матовая 200г";
								this.fnm = "матовая бумага 200 гр.";
								this.lst = new function () {
									this.aabca = new function () {
										this.nm = "односторонняя печать";
										this.ski = "b12";
										this.gr = grS;
										this.pr = prS[2].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[1]; }
									}
									this.aabcb = new function () {
										this.fnm = "двусторонняя печать";
										this.ski = "b12";
										this.gr = grS;
										this.pr = prS[3].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[1]; }
									}
									this.aabcc = new function () {
										this.fnm = "одностороннее копирование со стекла";
										this.ski = "b12";
										this.gr = grS;
										this.pr = prS[2].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[1] + cp; }
									}
									this.aabcd = new function () {
										this.fnm = "двустороннее копирование со стекла";
										this.ski = "b12";
										this.gr = grS;
										this.pr = prS[3].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[1] + cp; }
									}
								}
							}
							this.aabd = new function () {
								this.nm = "матовая 250г";
								this.fnm = "матовая бумага 250 гр.";
								this.lst = new function () {
									this.aabda = new function () {
										this.nm = "односторонняя печать";
										this.ski = "b13";
										this.gr = grS;
										this.pr = prS[2].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[2]; }
									}
									this.aabdb = new function () {
										this.fnm = "двусторонняя печать";
										this.ski = "b13";
										this.gr = grS;
										this.pr = prS[3].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[2]; }
									}
									this.aabdc = new function () {
										this.fnm = "одностороннее копирование со стекла";
										this.ski = "b13";
										this.gr = grS;
										this.pr = prS[2].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[2] + cp; }
									}
									this.aabdd = new function () {
										this.fnm = "двустороннее копирование со стекла";
										this.ski = "b13";
										this.gr = grS;
										this.pr = prS[3].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[2] + cp; }
									}
								}
							}
							this.aabe = new function () {
								this.nm = "матовая 280г";
								this.fnm = "матовая бумага 280 гр.";
								this.lst = new function () {
									this.aabea = new function () {
										this.nm = "односторонняя печать";
										this.ski = "b14";
										this.gr = grS;
										this.pr = prS[2].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[3]; }
									}
									this.aabeb = new function () {
										this.fnm = "двусторонняя печать";
										this.ski = "b14";
										this.gr = grS;
										this.pr = prS[3].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[3]; }
									}
									this.aabec = new function () {
										this.fnm = "одностороннее копирование со стекла";
										this.ski = "b14";
										this.gr = grS;
										this.pr = prS[2].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[3] + cp; }
									}
									this.aabed = new function () {
										this.fnm = "двустороннее копирование со стекла";
										this.ski = "b14";
										this.gr = grS;
										this.pr = prS[3].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[3] + cp; }
									}
								}
							}
							this.aabf = new function () {
								this.nm = "глянцевая 170г";
								this.fnm = "глянцевая бумага 170 гр.";
								this.lst = new function () {
									this.aabfa = new function () {
										this.nm = "односторонняя печать";
										this.ski = "b15";
										this.gr = grS;
										this.pr = prS[2].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[4]; }
									}
									this.aabfb = new function () {
										this.fnm = "двусторонняя печать";
										this.ski = "b15";
										this.gr = grS;
										this.pr = prS[3].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[4]; }
									}
									this.aabfс = new function () {
										this.fnm = "одностороннее копирование со стекла";
										this.ski = "b15";
										this.gr = grS;
										this.pr = prS[2].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[4] + cp; }
									}
									this.aabfd = new function () {
										this.fnm = "двустороннее копирование со стекла";
										this.ski = "b15";
										this.gr = grS;
										this.pr = prS[3].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[4] + cp; }
									}
								}
							}
							this.aabg = new function () {
								this.nm = "глянцевая 250г";
								this.fnm = "глянцевая бумага 250г гр.";
								this.lst = new function () {
									this.aabga = new function () {
										this.nm = "односторонняя печать";
										this.ski = "b3gl";
										this.gr = grS;
										this.pr = prS[2].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[5]; }
									}
									this.aabgb = new function () {
										this.fnm = "двусторонняя печать";
										this.ski = "b3gl";
										this.gr = grS;
										this.pr = prS[3].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[5]; }
									}
									this.aabgс = new function () {
										this.fnm = "одностороннее копирование со стекла";
										this.ski = "b3gl";
										this.gr = grS;
										this.pr = prS[2].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[5] + cp; }
									}
									this.aabgd = new function () {
										this.fnm = "двустороннее копирование со стекла";
										this.ski = "b3gl";
										this.gr = grS;
										this.pr = prS[3].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[5] + cp; }
									}
								}
							}
							this.aabh = new function () {
								this.nm = "калька 250г";
								this.fnm = "калька бумага 250 гр.";
								this.lst = new function () {
									this.aabha = new function () {
										this.nm = "односторонняя печать";
										this.ski = "b3k";
										this.gr = grS;
										this.pr = prS[2].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[6]; }
									}
									this.aabhb = new function () {
										this.fnm = "двусторонняя печать";
										this.ski = "b3k";
										this.gr = grS;
										this.pr = prS[3].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[6]; }
									}
									this.aabhс = new function () {
										this.fnm = "одностороннее копирование со стекла";
										this.ski = "b3k";
										this.gr = grS;
										this.pr = prS[2].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[6] + cp; }
									}
									this.aabhd = new function () {
										this.fnm = "двустороннее копирование со стекла";
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
						this.fnm = "формат А2";
						this.lst = new function () {
							this.aaca = new function () {
								this.nm = "обычная 80г";
								this.fnm = "обычная бумага 80 гр.";
								this.lst = new function () {
									this.aacaa = new function () {
										this.nm = "заливка менее 20%";
										this.skm = 0.25;
										this.ski = "b16";
										this.gr = grL;
										this.pr = prL[0];
									}
									this.aacab = new function () {
										this.nm = "заливка более 20%";
										this.fnm = "заливка более 20%";
										this.skm = 0.25;
										this.ski = "b16";
										this.gr = grL;
										this.pr = prL[1];
									}
								}
							}
							this.aacb = new function () {
								this.nm = "матовая 180г";
								this.fnm = "матовая бумага 180 гр.";
								this.skm = 0.25;
								this.ski = "b17";
								this.pr = prU[0][0];
							}
							this.aacc = new function () {
								this.nm = "глянец HP";
								this.fnm = "глянцевая бумага HP";
								this.skm = 0.25;
								this.ski = "b18";
								this.pr = prU[0][1];
							}
							this.aacd = new function () {
								this.nm = "калька 90г";
								this.fnm = "калька 90 гр.";
								this.skm = 0.25;
								this.ski = "b19";
								this.pr = prU[0][2];
							}
							this.aace = new function () {
								this.nm = "самоклейка";
								this.fnm = "самоклейка";
								this.skm = 0.25;
								this.ski = "b20";
								this.pr = prU[0][3];
							}
							this.aacf = new function () {
								this.nm = "холст 320г";
								this.fnm = "холст 320 гр.";
								this.skm = 0.25;
								this.ski = "b21";
								this.pr = prU[0][4];
							}
						}
					}
					this.aad = new function () {
						this.nm = "А1";
						this.fnm = "формат А1";
						this.lst = new function () {
							this.aada = new function () {
								this.nm = "обычная 80г";
								this.fnm = "обычная бумага 80 гр.";
								this.lst = new function () {
									this.aadaa = new function () {
										this.nm = "заливка менее 20%";
										this.skm = 0.5;
										this.ski = "b16";
										this.gr = grL;
										this.pr = prL[2];
									}
									this.aadab = new function () {
										this.nm = "заливка более 20%";
										this.fnm = "заливка более 20%";
										this.skm = 0.5;
										this.ski = "b16";
										this.gr = grL;
										this.pr = prL[3];
									}
								}
							}
							this.aadb = new function () {
								this.nm = "матовая 180г";
								this.fnm = "матовая бумага 180 гр.";
								this.skm = 0.5;
								this.ski = "b17";
								this.pr = prU[1][0];
							}
							this.aadc = new function () {
								this.nm = "глянец HP";
								this.fnm = "глянцевая бумага HP";
								this.skm = 0.5;
								this.ski = "b18";
								this.pr = prU[1][1];
							}
							this.aadd = new function () {
								this.nm = "калька 90г";
								this.fnm = "калька 90 гр.";
								this.skm = 0.5;
								this.ski = "b19";
								this.pr = prU[1][2];
							}
							this.aade = new function () {
								this.nm = "самоклейка";
								this.fnm = "самоклейка";
								this.skm = 0.5;
								this.ski = "b20";
								this.pr = prU[1][3];
							}
							this.aadf = new function () {
								this.nm = "холст 320г";
								this.fnm = "холст 320 гр.";
								this.skm = 0.5;
								this.ski = "b21";
								this.pr = prU[1][4];
							}
						}
					}
					this.aae = new function () {
						this.nm = "А0";
						this.fnm = "формат А0";
						this.lst = new function () {
							this.aaea = new function () {
								this.nm = "обычная 80г";
								this.fnm = "обычная бумага 80 гр.";
								this.lst = new function () {
									this.aaeaa = new function () {
										this.nm = "заливка менее 20%";
										this.ski = "b16";
										this.gr = grL;
										this.pr = prL[4];
									}
									this.aaeab = new function () {
										this.nm = "заливка более 20%";
										this.fnm = "заливка более 20%";
										this.ski = "b16";
										this.gr = grL;
										this.pr = prL[5];
									}
								}
							}
							this.aaeb = new function () {
								this.nm = "матовая 180г";
								this.fnm = "матовая бумага 180 гр.";
								this.ski = "b17";
								this.pr = prU[2][0];
							}
							this.aaec = new function () {
								this.nm = "глянец HP";
								this.fnm = "глянцевая бумага HP";
								this.ski = "b18";
								this.pr = prU[2][1];
							}
							this.aaed = new function () {
								this.nm = "калька 90г";
								this.fnm = "калька 90 гр.";
								this.ski = "b19";
								this.pr = prU[2][2];
							}
							this.aaee = new function () {
								this.nm = "самоклейка";
								this.fnm = "самоклейка";
								this.ski = "b20";
								this.pr = prU[2][3];
							}
							this.aaef = new function () {
								this.nm = "холст 320г";
								this.fnm = "холст 320 гр.";
								this.ski = "b21";
								this.pr = prU[2][4];
							}
						}
					}
					this.aaf = new function () {
						this.nm = "Нестнд";
						this.fnm = "нестандартный формат";
						this.lst = new function () {
							this.aafa = new function () {
								this.nm = "обычная 80г";
								this.fnm = "обычная бумага 80 гр.";
								this.lst = new function () {
									this.aafaa = new function () {
										this.nm = "заливка менее 20%";
										this.me = "кв. м.";
										this.ski = "b16";
										this.gr = grL;
										this.pr = prL[6];
									}
									this.aafab = new function () {
										this.nm = "заливка более 20%";
										this.fnm = "заливка более 20%";
										this.me = "кв. м.";
										this.ski = "b16";
										this.gr = grL;
										this.pr = prL[7];
									}
								}
							}
							this.aafb = new function () {
								this.nm = "матовая 180г";
								this.fnm = "матовая бумага 180 гр.";
								this.me = "кв. м.";
								this.ski = "b17";
								this.pr = prU[3][0];
							}
							this.aafc = new function () {
								this.nm = "глянец HP";
								this.fnm = "глянцевая бумага HP";
								this.me = "кв. м.";
								this.ski = "b18";
								this.pr = prU[3][1];
							}
							this.aafd = new function () {
								this.nm = "калька 90г";
								this.fnm = "калька 90 гр.";
								this.me = "кв. м.";
								this.ski = "b19";
								this.pr = prU[3][2];
							}
							this.aafe = new function () {
								this.nm = "самоклейка";
								this.fnm = "самоклейка";
								this.me = "кв. м.";
								this.ski = "b20";
								this.pr = prU[3][3];
							}
							this.aaff = new function () {
								this.nm = "холст 320г";
								this.fnm = "холст 320 гр.";
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
				this.fnm = "Черно белая печать";
				let grS = [0,10000000,10000000,10000000,10000000,10000000,10000000,10000000];
				this.gradS = grS;
				let prS = [
					[2.28,2.28,2.28,2.28,2.28,2.28,2.28,2.28], // A4 односторон печать
					[3.6,3.6,3.6,3.6,3.6,3.6,3.6,3.6], // A4 двусторонн печать
					[4.80,4.80,4.80,4.80,4.80,4.80,4.80,4.80], // A3 односторон печать
					[7.20,7.20,7.20,7.20,7.20,7.20,7.20,7.20] // A3 двусторонн печать

				]
				for (k in prS) {
					for (l in prS[k]) {
						prS[k][l] = Math.round(prS[k][l]*z)/100;
					}
				}
				this.priceS = prS;
				let grL = [0,10000000,10000000,10000000];
				this.gradL = grL;
				let prL = [
					[24,24,24,24], //A2 обычная 80г
					[48,48,48,48], //A2 калька 90г
					[36,36,36,36], //A1 обычная 80г
					[72,72,72,72], //A1 калька 90г
					[72,72,72,72], //A0 обычная 80г
					[144,144,144,144], //A0 калька 90г
					[72,72,72,72], //нестд обычная 80г
					[144,144,144,144] //нестд калька 90г
				]
				for (k in prL) {
					for (l in prL[k]) {
						prL[k][l] = Math.round(prL[k][l]*z)/100;
					}
				}
				this.priceL = prL;
				this.lst = new function () {
					this.aba = new function () {
						this.nm = "А4";
						this.fnm = "формат А4";
						this.lst = new function () {
							this.abaa = new function () {
								this.nm = "обычная 80г";
								this.fnm = "обычная бумага 80 гр.";
								this.lst = new function () {
									this.abaaa = new function () {
										this.nm = "односторонняя печать";
										this.ski = "b1";
										this.gr = grS;
										this.pr = prS[0].slice(0);
									}
									this.abaab = new function () {
										this.fnm = "двусторонняя печать";
										this.ski = "b1";
										this.gr = grS;
										this.pr = prS[1].slice(0);
									}
									this.abaaс = new function () {
										this.fnm = "одностороннее копирование со стекла";
										this.gr = grS;
										this.pr = prS[0].slice(0);
										for (k in this.pr) { this.pr[k] += cp; }
									}
									this.abaad = new function () {
										this.fnm = "двустороннее копирование со стекла";
										this.gr = grS;
										this.pr = prS[1].slice(0);
										for (k in this.pr) { this.pr[k] += cp; }
									}
								}
							}
							this.abab = new function () {
								this.nm = "матовая 120г";
								this.fnm = "матовая бумага 120 гр.";
								this.lst = new function () {
									this.ababa = new function () {
										this.nm = "односторонняя печать";
										this.ski = "b2";
										this.gr = grS;
										this.pr = prS[0].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[0]; }
									}
									this.ababb = new function () {
										this.fnm = "двусторонняя печать";
										this.ski = "b2";
										this.gr = grS;
										this.pr = prS[1].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[0]; }
									}
									this.ababс = new function () {
										this.fnm = "одностороннее копирование со стекла";
										this.ski = "b2";
										this.gr = grS;
										this.pr = prS[0].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[0] + cp; }
									}
									this.ababd = new function () {
										this.fnm = "двустороннее копирование со стекла";
										this.ski = "b2";
										this.gr = grS;
										this.pr = prS[1].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[0] + cp; }
									}
								}
							}
							this.abac = new function () {
								this.nm = "матовая 160г";
								this.fnm = "матовая бумага 160 гр.";
								this.lst = new function () {
									this.abaca = new function () {
										this.nm = "односторонняя печать";
										this.ski = "b3";
										this.gr = grS;
										this.pr = prS[0].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[1]; }
									}
									this.abacb = new function () {
										this.fnm = "двусторонняя печать";
										this.ski = "b3";
										this.gr = grS;
										this.pr = prS[1].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[1]; }
									}
									this.abacс = new function () {
										this.fnm = "одностороннее копирование со стекла";
										this.ski = "b3";
										this.gr = grS;
										this.pr = prS[0].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[1] + cp; }
									}
									this.abacd = new function () {
										this.fnm = "двустороннее копирование со стекла";
										this.ski = "b3";
										this.gr = grS;
										this.pr = prS[1].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[1] + cp; }
									}
								}
							}
							this.abad = new function () {
								this.nm = "матовая 200г";
								this.fnm = "матовая бумага 200 гр.";
								this.lst = new function () {
									this.abada = new function () {
										this.nm = "односторонняя печать";
										this.ski = "b4";
										this.gr = grS;
										this.pr = prS[0].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[2]; }
									}
									this.abadb = new function () {
										this.fnm = "двусторонняя печать";
										this.ski = "b4";
										this.gr = grS;
										this.pr = prS[1].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[2]; }
									}
									this.abadс = new function () {
										this.fnm = "одностороннее копирование со стекла";
										this.ski = "b4";
										this.gr = grS;
										this.pr = prS[0].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[2] + cp; }
									}
									this.abadd = new function () {
										this.fnm = "двустороннее копирование со стекла";
										this.ski = "b4";
										this.gr = grS;
										this.pr = prS[1].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[2] + cp; }
									}
								}
							}
							this.abae = new function () {
								this.nm = "матовая 250г";
								this.fnm = "матовая бумага 250 гр.";
								this.lst = new function () {
									this.abaea = new function () {
										this.nm = "односторонняя печать";
										this.ski = "b5";
										this.gr = grS;
										this.pr = prS[0].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[3]; }
									}
									this.abaeb = new function () {
										this.fnm = "двусторонняя печать";
										this.ski = "b5";
										this.gr = grS;
										this.pr = prS[1].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[3]; }
									}
									this.abaeс = new function () {
										this.fnm = "одностороннее копирование со стекла";
										this.ski = "b5";
										this.gr = grS;
										this.pr = prS[0].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[3] + cp; }
									}
									this.abaed = new function () {
										this.fnm = "двустороннее копирование со стекла";
										this.ski = "b5";
										this.gr = grS;
										this.pr = prS[1].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[3] + cp; }
									}
								}
							}
							this.abaf = new function () {
								this.nm = "матовая 300г";
								this.fnm = "матовая бумага 300 гр.";
								this.lst = new function () {
									this.abafa = new function () {
										this.nm = "односторонняя печать";
										this.ski = "b6";
										this.gr = grS;
										this.pr = prS[0].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[4]; }
									}
									this.abafb = new function () {
										this.fnm = "двусторонняя печать";
										this.ski = "b6";
										this.gr = grS;
										this.pr = prS[1].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[4]; }
									}
									this.abafс = new function () {
										this.fnm = "одностороннее копирование со стекла";
										this.ski = "b6";
										this.gr = grS;
										this.pr = prS[0].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[4] + cp; }
									}
									this.abafd = new function () {
										this.fnm = "двустороннее копирование со стекла";
										this.ski = "b6";
										this.gr = grS;
										this.pr = prS[1].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[4] + cp; }
									}
								}
							}
							this.abag = new function () {
								this.nm = "глянец 170г";
								this.fnm = "глянцевая бумага 170 гр.";
								this.lst = new function () {
									this.abaga = new function () {
										this.nm = "односторонняя печать";
										this.ski = "b7";
										this.gr = grS;
										this.pr = prS[0].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[5]; }
									}
									this.abagb = new function () {
										this.fnm = "двусторонняя печать";
										this.ski = "b7";
										this.gr = grS;
										this.pr = prS[1].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[5]; }
									}
									this.abagс = new function () {
										this.fnm = "одностороннее копирование со стекла";
										this.ski = "b7";
										this.gr = grS;
										this.pr = prS[0].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[5] + cp; }
									}
									this.abagd = new function () {
										this.fnm = "двустороннее копирование со стекла";
										this.ski = "b7";
										this.gr = grS;
										this.pr = prS[1].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[5] + cp; }
									}
								}
							}
							this.abah = new function () {
								this.nm = "глянец 250г";
								this.fnm = "глянцевая бумага 250 гр.";
								this.lst = new function () {
									this.abaha = new function () {
										this.nm = "односторонняя печать";
										this.ski = "b8";
										this.gr = grS;
										this.pr = prS[0].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[6]; }
									}
									this.abahb = new function () {
										this.fnm = "двусторонняя печать";
										this.ski = "b8";
										this.gr = grS;
										this.pr = prS[1].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[6]; }
									}
									this.abahс = new function () {
										this.fnm = "одностороннее копирование со стекла";
										this.ski = "b8";
										this.gr = grS;
										this.pr = prS[0].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[6] + cp; }
									}
									this.abahd = new function () {
										this.fnm = "двустороннее копирование со стекла";
										this.ski = "b8";
										this.gr = grS;
										this.pr = prS[1].slice(0);
										for (k in this.pr) { this.pr[k] += bA4[6] + cp; }
									}
								}
							}
							this.abai = new function () {
								this.nm = "самоклейка";
								this.fnm = "самоклейка";
								this.ski = "b9";
								this.gr = grS;
								this.pr = prS[0].slice(0);
								for (k in this.pr) { this.pr[k] += bA4[7]; }
							}
						}
					}
					this.abb = new function () {
						this.nm = "А3";
						this.fnm = "формат А3";
						this.lst = new function () {
							this.abba = new function () {
								this.nm = "обычная 80г";
								this.fnm = "обычная бумага 80 гр.";
								this.lst = new function () {
									this.abbaa = new function () {
										this.nm = "односторонняя печать";
										this.ski = "b10";
										this.gr = grS;
										this.pr = prS[2].slice(0);
									}
									this.abbab = new function () {
										this.fnm = "двусторонняя печать";
										this.ski = "b10";
										this.gr = grS;
										this.pr = prS[3].slice(0);
									}
									this.abbaс = new function () {
										this.fnm = "одностороннее копирование со стекла";
										this.ski = "b10";
										this.gr = grS;
										this.pr = prS[2].slice(0);
										for (k in this.pr) { this.pr[k] += cp; }
									}
									this.abbad = new function () {
										this.fnm = "двустороннее копирование со стекла";
										this.ski = "b10";
										this.gr = grS;
										this.pr = prS[3].slice(0);
										for (k in this.pr) { this.pr[k] += cp; }
									}
								}
							}
							this.abbb = new function () {
								this.nm = "матовая 160г";
								this.fnm = "матовая бумага 160 гр.";
								this.lst = new function () {
									this.abbba = new function () {
										this.nm = "односторонняя печать";
										this.ski = "b11";
										this.gr = grS;
										this.pr = prS[2].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[0]; }
									}
									this.abbbb = new function () {
										this.fnm = "двусторонняя печать";
										this.ski = "b11";
										this.gr = grS;
										this.pr = prS[3].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[0]; }
									}
									this.abbbс = new function () {
										this.fnm = "одностороннее копирование со стекла";
										this.ski = "b11";
										this.gr = grS;
										this.pr = prS[2].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[0] + cp; }
									}
									this.abbbd = new function () {
										this.fnm = "двустороннее копирование со стекла";
										this.ski = "b11";
										this.gr = grS;
										this.pr = prS[3].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[0] + cp; }
									}
								}
							}
							this.abbc = new function () {
								this.nm = "матовая 200г";
								this.fnm = "матовая бумага 200 гр.";
								this.lst = new function () {
									this.abbca = new function () {
										this.nm = "односторонняя печать";
										this.ski = "b12";
										this.gr = grS;
										this.pr = prS[2].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[1]; }
									}
									this.abbcb = new function () {
										this.fnm = "двусторонняя печать";
										this.ski = "b12";
										this.gr = grS;
										this.pr = prS[3].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[1]; }
									}
									this.abbcс = new function () {
										this.fnm = "одностороннее копирование со стекла";
										this.ski = "b12";
										this.gr = grS;
										this.pr = prS[2].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[1] + cp; }
									}
									this.abbcd = new function () {
										this.fnm = "двустороннее копирование со стекла";
										this.ski = "b12";
										this.gr = grS;
										this.pr = prS[3].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[1] + cp; }
									}
								}
							}
							this.abbd = new function () {
								this.nm = "матовая 250г";
								this.fnm = "матовая бумага 250 гр.";
								this.lst = new function () {
									this.abbda = new function () {
										this.nm = "односторонняя печать";
										this.ski = "b13";
										this.gr = grS;
										this.pr = prS[2].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[2]; }
									}
									this.abbdb = new function () {
										this.fnm = "двусторонняя печать";
										this.ski = "b13";
										this.gr = grS;
										this.pr = prS[3].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[2]; }
									}
									this.abbdс = new function () {
										this.fnm = "одностороннее копирование со стекла";
										this.ski = "b13";
										this.gr = grS;
										this.pr = prS[2].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[2] + cp; }
									}
									this.abbdd = new function () {
										this.fnm = "двустороннее копирование со стекла";
										this.ski = "b13";
										this.gr = grS;
										this.pr = prS[3].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[2] + cp; }
									}
								}
							}
							this.abbe = new function () {
								this.nm = "матовая 280г";
								this.fnm = "матовая бумага 280 гр.";
								this.lst = new function () {
									this.abbea = new function () {
										this.nm = "односторонняя печать";
										this.ski = "b14";
										this.gr = grS;
										this.pr = prS[2].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[3]; }
									}
									this.abbeb = new function () {
										this.fnm = "двусторонняя печать";
										this.ski = "b14";
										this.gr = grS;
										this.pr = prS[3].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[3]; }
									}
									this.abbeс = new function () {
										this.fnm = "одностороннее копирование со стекла";
										this.ski = "b14";
										this.gr = grS;
										this.pr = prS[2].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[3] + cp; }
									}
									this.abbed = new function () {
										this.fnm = "двустороннее копирование со стекла";
										this.ski = "b14";
										this.gr = grS;
										this.pr = prS[3].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[3] + cp; }
									}
								}
							}
							this.abbf = new function () {
								this.nm = "глянцевая 170г";
								this.fnm = "глянцевая бумага 170 гр.";
								this.lst = new function () {
									this.abbfa = new function () {
										this.nm = "односторонняя печать";
										this.ski = "b15";
										this.gr = grS;
										this.pr = prS[2].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[4]; }
									}
									this.abbfb = new function () {
										this.fnm = "двусторонняя печать";
										this.ski = "b15";
										this.gr = grS;
										this.pr = prS[3].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[4]; }
									}
									this.abbfc = new function () {
										this.fnm = "одностороннее копирование со стекла";
										this.ski = "b15";
										this.gr = grS;
										this.pr = prS[2].slice(0);
										for (k in this.pr) { this.pr[k] += bA3[4] + cp; }
									}
									this.abbfd = new function () {
										this.fnm = "двустороннее копирование со стекла";
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
						this.fnm = "формат А2";
						this.lst = new function () {
							this.abca = new function () {
								this.nm = "обычная 80г";
								this.fnm = "обычная бумага 80 гр.";
								this.skm = 0.25;
								this.ski = "b16";
								this.gr = grL;
								this.pr = prL[0];
							}
							this.abcb = new function () {
								this.nm = "калька 90г";
								this.fnm = "калька 90 гр.";
								this.skm = 0.25;
								this.ski = "b19";
								this.gr = grL;
								this.pr = prL[1];
							}
						}
					}
					this.abd = new function () {
						this.nm = "А1";
						this.fnm = "формат А1";
						this.lst = new function () {
							this.abda = new function () {
								this.nm = "обычная 80г";
								this.fnm = "обычная бумага 80 гр.";
								this.skm = 0.5;
								this.ski = "b16";
								this.gr = grL;
								this.pr = prL[2];
							}
							this.abdb = new function () {
								this.nm = "калька 90г";
								this.fnm = "калька 90 гр.";
								this.skm = 0.5;
								this.ski = "b19";
								this.gr = grL;
								this.pr = prL[3];
							}
						}
					}
					this.abe = new function () {
						this.nm = "А0";
						this.fnm = "формат А0";
						this.lst = new function () {
							this.abea = new function () {
								this.nm = "обычная 80г";
								this.fnm = "обычная бумага 80 гр.";
								this.ski = "b16";
								this.gr = grL;
								this.pr = prL[4];
							}
							this.abeb = new function () {
								this.nm = "калька 90г";
								this.fnm = "калька 90 гр.";
								this.ski = "b19";
								this.gr = grL;
								this.pr = prL[5];
							}
						}
					}
					this.abf = new function () {
						this.nm = "Нестнд";
						this.fnm = "нестандартный формат";
						this.lst = new function () {
							this.abfa = new function () {
								this.nm = "обычная 80г";
								this.fnm = "обычная бумага 80 гр.";
								this.me = "кв. м.";
								this.ski = "b16";
								this.gr = grL;
								this.pr = prL[6];
							}
							this.abfb = new function () {
								this.nm = "калька 90г";
								this.fnm = "калька 90 гр.";
								this.me = "кв. м.";
								this.ski = "b19";
								this.gr = grL;
								this.pr = prL[7];
							}
						}
					}
				}
			}
		}
	}

	this.b = new function () {
		this.nm = "Переплет";
		let pr = [
			[72,96,120], //пласт А4: малая, средняя, большая
			[144,192,240], //пласт А3: малая, средняя, большая
			[198,224.4,250.8], //металл А4: малая, средняя, большая
			[237.6,277.2,303.6], //металл А3: малая, средняя, большая
			[475.2,528,580.8,627], //Твердый: 5-7, 10-13, 16-20, 24-32
			[39.6,66,66] // Вставка конверта, Вставка файла, Пластиковая переброшюровка
		];
		for (k in pr) {
			for (l in pr[k]) {
				pr[k][l] = Math.round(pr[k][l]*z)/100;
			}
		}
		this.price = pr;

		this.lst = new function () {
			this.ba = new function () {
				this.nm = "пластиковая пружина";
				this.fnm = "Переплет пластиковой пружиной";
				this.lst = new function () {
					this.baa = new function () {
						this.nm = "A4";
						this.fnm = "формат А4";
						this.lst = new function () {
							this.baaa = new function () {
								this.nm = "маленькая, до 100 л";
								this.fnm = "маленькая пружина";
								this.lst = new function () {
									this.baaaa = new function () {
										this.nm = "новый переплет";
										this.ski = "p1";
										this.ski2 = "p12";
										this.pr = pr[0][0];
									}
									this.baaab = new function () {
										this.nm = "переброшюровка";
										this.fnm = "(переброшюровка)";
										this.pr = pr[5][2];
									}
								}
							}
							this.baab = new function () {
								this.nm = "средняя, 100-240 л";
								this.fnm = "средняя пружина";
								this.lst = new function () {
									this.baaba = new function () {
										this.nm = "новый переплет";
										this.ski = "p2";
										this.ski2 = "p12";
										this.pr = pr[0][1];
									}
									this.baabb = new function () {
										this.nm = "переброшюровка";
										this.fnm = "(переброшюровка)";
										this.pr = pr[5][2];
									}
								}
							}
							this.baac = new function () {
								this.nm = "большая, 240-480 л";
								this.fnm = "большая пружина";
								this.lst = new function () {
									this.baaca = new function () {
										this.nm = "новый переплет";
										this.ski = "p3";
										this.ski2 = "p12";
										this.pr = pr[0][2];
									}
									this.baacb = new function () {
										this.nm = "переброшюровка";
										this.fnm = "(переброшюровка)";
										this.pr = pr[5][2];
									}
								}
							}
						}
					}
					this.bab = new function () {
						this.nm = "A3";
						this.fnm = "формат А3";
						this.lst = new function () {
							this.baba = new function () {
								this.nm = "маленькая, до 100 л";
								this.fnm = "маленькая пружина";
								this.lst = new function () {
									this.babaa = new function () {
										this.nm = "новый переплет";
										this.ski = "p1";
										this.ski2 = "p13";
										this.pr = pr[1][0];
									}
									this.babab = new function () {
										this.nm = "переброшюровка";
										this.fnm = "(переброшюровка)";
										this.pr = pr[5][2];
									}
								}
							}
							this.babb = new function () {
								this.nm = "средняя, 100-240 л";
								this.fnm = "средняя пружина";
								this.lst = new function () {
									this.babba = new function () {
										this.nm = "новый переплет";
										this.ski = "p2";
										this.ski2 = "p13";
										this.pr = pr[1][1];
									}
									this.babbb = new function () {
										this.nm = "переброшюровка";
										this.fnm = "(переброшюровка)";
										this.pr = pr[5][2];
									}
								}
							}
							this.babc = new function () {
								this.nm = "большая, 240-480 л";
								this.fnm = "большая пружина";
								this.lst = new function () {
									this.babca = new function () {
										this.nm = "новый переплет";
										this.ski = "p3";
										this.ski2 = "p13";
										this.pr = pr[1][2];
									}
									this.babcb = new function () {
										this.nm = "переброшюровка";
										this.fnm = "(переброшюровка)";
										this.pr = pr[5][2];
									}
								}
							}
						}
					}
				}
			}
			this.bb = new function () {
				this.nm = "металлическая пружина";
				this.fnm = "Переплет металлической пружиной";
				this.pr = 250;
				
				/*this.lst = new function () {
					this.bba = new function () {
						this.nm = "A4";
						this.fnm = "формат А4";
						this.lst = new function () {
							this.bbaa = new function () {
								this.nm = "маленькая, до 60 л";
								this.fnm = "маленькая пружина";
								this.lst = new function () {
									this.bbaaa = new function () {
										this.nm = "новый переплет";
										this.ski = "p4";
										this.ski2 = "p12";
										this.pr = pr[2][0];
									}
									this.bbaab = new function () {
										this.nm = "переброшюровка";
										this.fnm = "(переброшюровка)";
										this.ski = "p4";
										this.pr = Math.round(pr[2][0]/2);
									}
								}
							}
							this.bbab = new function () {
								this.nm = "средняя, 60-100 л";
								this.fnm = "средняя пружина";
								this.lst = new function () {
									this.bbaba = new function () {
										this.nm = "новый переплет";
										this.ski = "p5";
										this.ski2 = "p12";
										this.pr =  pr[2][1];
									}
									this.bbabb = new function () {
										this.nm = "переброшюровка";
										this.fnm = "(переброшюровка)";
										this.ski = "p5";
										this.pr = Math.round(pr[2][1]/2);
									}
								}
							}
							this.bbac = new function () {
								this.nm = "большая, 100-120 л";
								this.fnm = "большая пружина";
								this.lst = new function () {
									this.bbaca = new function () {
										this.nm = "новый переплет";
										this.ski = "p6";
										this.ski2 = "p12";
										this.pr =  pr[2][2];
									}
									this.bbacb = new function () {
										this.nm = "переброшюровка";
										this.fnm = "(переброшюровка)";
										this.ski = "p6";
										this.pr = Math.round(pr[2][2]/2);
									}
								}
							}
						}
					}
					this.bbb = new function () {
						this.nm = "A3";
						this.fnm = "формат А3";
						this.lst = new function () {
							this.bbba = new function () {
								this.nm = "маленькая, до 60 л";
								this.fnm = "маленькая пружина";
								this.lst = new function () {
									this.bbbaa = new function () {
										this.nm = "новый переплет";
										this.ski = "p4";
										this.ski2 = "p13";
										this.pr = pr[3][0];
									}
									this.bbbab = new function () {
										this.nm = "переброшюровка";
										this.fnm = "(переброшюровка)";
										this.ski = "p4";
										this.pr = Math.round(pr[3][2]/2);
									}
								}
							}
							this.bbbb = new function () {
								this.nm = "средняя, 60-100 л";
								this.fnm = "средняя пружина";
								this.lst = new function () {
									this.bbbba = new function () {
										this.nm = "новый переплет";
										this.ski = "p5";
										this.ski2 = "p13";
										this.pr = pr[3][1];
									}
									this.bbbbb = new function () {
										this.nm = "переброшюровка";
										this.fnm = "(переброшюровка)";
										this.ski = "p5";
										this.pr = Math.round(pr[3][2]/2);
									}
								}
							}
							this.bbbc = new function () {
								this.nm = "большая, 100-120 л";
								this.fnm = "большая пружина";
								this.lst = new function () {
									this.bbbca = new function () {
										this.nm = "новый переплет";
										this.ski = "p6";
										this.ski2 = "p13";
										this.pr = pr[3][2];
									}
									this.bbbcb = new function () {
										this.nm = "переброшюровка";
										this.fnm = "(переброшюровка)";
										this.ski = "p6";
										this.pr = Math.round(pr[3][2]/2);
									}
								}
							}
						}
					}
				}*/
			}
			this.bc = new function () {
				this.nm = "твердый переплет";
				this.fnm = "Твердый переплет";
				this.lst = new function () {
					this.bca = new function () {
						this.nm = "5-7 мм.";
						this.fnm = "корешок 5-7 мм.";
						this.lst = new function () {
							this.bcaa = new function () {
								this.nm = "новый переплет";
								this.ski = "p7";
								this.ski2 = 'p11';
								this.skm2 = 2;
								this.pr = pr[4][0];
							}
							this.bcab = new function () {
								this.nm = "переброшюровка";
								this.fnm = "(переброшюровка)";
								this.pr = Math.round(pr[4][0]/2);
							}
						}
					}
					this.bcb = new function () {
						this.nm = "10-13 мм.";
						this.fnm = "корешок 10-13 мм.";
						this.lst = new function () {
							this.bcba = new function () {
								this.nm = "новый переплет";
								this.ski = "p8";
								this.ski2 = 'p11';
								this.skm2 = 2;
								this.pr = pr[4][1];
							}
							this.bcbb = new function () {
								this.nm = "переброшюровка";
								this.fnm = "(переброшюровка)";
								this.pr = Math.round(pr[4][1]/2);
							}
						}
					}
					this.bcc = new function () {
						this.nm = "16-20 мм.";
						this.fnm = "корешок 16-20 мм.";
						this.lst = new function () {
							this.bcca = new function () {
								this.nm = "новый переплет";
								this.ski = "p9";
								this.ski2 = 'p11';
								this.skm2 = 2;
								this.pr = pr[4][2];
							}
							this.bccb = new function () {
								this.nm = "переброшюровка";
								this.fnm = "(переброшюровка)";
								this.pr = Math.round(pr[4][2]/2);
							}
						}
					}
					this.bcd = new function () {
						this.nm = "24-32 мм.";
						this.fnm = "корешок 24-32 мм.";
						this.lst = new function () {
							this.bcda = new function () {
								this.nm = "новый переплет";
								this.ski = "p10";
								this.ski2 = 'p11';
								this.skm2 = 2;
								this.pr = pr[4][3];
							}
							this.bcdb = new function () {
								this.nm = "переброшюровка";
								this.fnm = "(переброшюровка)";
								this.pr = Math.round(pr[4][3]/2);
							}
						}
					}
				}
			}
			this.bd = new function () {
				this.fnm = "Вставка конверта для CD";
				this.pr = pr[5][0];
			}
			this.be = new function () {
				this.fnm = "Вставка файла в переплёт";
				this.pr = pr[5][1];
			}
		}
	}

	this.c = new function () {
		this.nm = "Прочее";
		let ppr = [
			10,7,39.6,13.2,250,26.4, //Резка, Ручная резка, Отправка-прием файлов, Работа на компе, Набор текста, Доработка файлов
			66,132,105.6,0.66,7.92, //диск клиента, диск компании, Сшивание/расшивание, Перфорация листов, Степлер
			7.92,158.4,792,52.8,6.6,13.2] //Биговка, Тиснение, Доставка, Папка скоросшиватель, Файл A4, Файл A3
 		for (k in ppr) { ppr[k] = Math.round(ppr[k]*z)/100; }
 		this.price = ppr;

		this.lst = new function () {

			this.ca = new function () {
				this.nm = "Сканирование";
				let gr = [0,10,50,100,500]; // градиент цен
				this.grad = gr;
				let pr = [
					[13.2,10.56,7.92,5.28,3.96], // А4 авто
					[19.8,15.84,11.88,7.92,5.94], // А4 руч
					[19.8,15.84,11.88,9.24,6.6], // А3 авто
					[29.7,23.76,17.82,13.86,9.9], // А3 руч
					[46.2,33,26.4,19.8,15.84], // А2
					[85.8,72.6,59.4,46.2,33], // А1
					[145.2,125.4,112.2,99,85.8] // A0
				];
				for (k in pr) {
					for (l in pr[k]) {
						pr[k][l] = Math.round(pr[k][l]*z)/100;
					}
				}
				this.price = pr;
				this.lst = new function () {
					this.caa = new function () {
						this.nm = "A4";
						this.fnm = "Сканирование формат А4";
						this.lst = new function () {
							this.caaa = new function () {
								this.nm = "автоскан";
								this.gr = gr;
								this.pr = pr[0];
							}
							this.caab = new function () {
								this.nm = "со стекла";
								this.fnm = "со стекла";
								this.gr = gr;
								this.pr = pr[1];
							}
						}
					}
					this.cab = new function () {
						this.nm = "A3";
						this.fnm = "Сканирование формат А3";
						this.lst = new function () {
							this.caba = new function () {
								this.nm = "автоскан";
								this.gr = gr;
								this.pr = pr[2];
							}
							this.cabb = new function () {
								this.nm = "со стекла";
								this.fnm = "со стекла";
								this.gr = gr;
								this.pr = pr[3];
							}
						}
					}
					this.cac = new function () {
						this.nm = "A2";
						this.fnm = "Сканирование формат А2";
						this.gr = gr;
						this.pr = pr[4];
					}
					this.cad = new function () {
						this.nm = "A1";
						this.fnm = "Сканирование формат А1";
						this.gr = gr;
						this.pr = pr[5];
					}
					this.cae = new function () {
						this.nm = "A0";
						this.fnm = "Сканирование формат А0";
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
					[66,52.8,39.6], //глянц А6
					[72.6,59.4,46.2], //глянц А5
					[85.8,72.6,59.4], //глянц А4
					[112.2,99,85.8], //глянц А3
					[72.6,59.4,46.2], //мат А6
					[79.2,66,52.8], //мат А5
					[92.4,79.2,66], //мат А4
					[118.8,105.6,92.4] //мат А3
				];
				for (k in pr) {
					for (l in pr[k]) {
						pr[k][l] = Math.round(pr[k][l]*z)/100;
					}
				}
				this.price = pr;
				this.lst = new function() {
					this.cba = new function() {
						this.nm = "глянцевое";
						this.fnm = "Глянцевое ламинирование";
						this.lst = new function () {
							this.cbaa = new function () {
								this.nm = "A6";
								this.fnm = "формат А6";
								this.gr = gr;
								this.pr = pr[0];
							}
							this.cbab = new function () {
								this.nm = "A5";
								this.fnm = "формат А5";
								this.gr = gr;
								this.pr = pr[1];
							}
							this.cbac = new function () {
								this.nm = "A4";
								this.fnm = "формат А4";
								this.gr = gr;
								this.pr = pr[2];
							}
							this.cbad = new function () {
								this.nm = "A3";
								this.fnm = "формат А3";
								this.gr = gr;
								this.pr = pr[3];
							}
						}
					}
					this.cbb = new function() {
						this.nm = "матовое";
						this.fnm = "Матовое ламинирование";
						this.lst = new function () {
							this.cbba = new function () {
								this.nm = "A6";
								this.fnm = "формат А6";
								this.gr = gr;
								this.pr = pr[4];
							}
							this.cbbb = new function () {
								this.nm = "A5";
								this.fnm = "формат А5";
								this.gr = gr;
								this.pr = pr[5];
							}
							this.cbbc = new function () {
								this.nm = "A4";
								this.fnm = "формат А4";
								this.gr = gr;
								this.pr = pr[6];
							}
							this.cbbd = new function () {
								this.nm = "A3";
								this.fnm = "формат А3";
								this.gr = gr;
								this.pr = pr[7];
							}
						}
					}
				}
			}
			this.co = new function () {
				this.fnm = "Фальцовка";
				this.gr = [0,100];
				this.pr = [26.4,19.8];
				for (k in this.pr) { this.pr[k] = Math.round(this.pr[k]*z)/100; }
			}
			this.cl = new function () {
				this.fnm = "Резка";
				this.pr = ppr[0];
			}
			this.cm = new function () {
				this.fnm = "Ручная резка";
				this.pr = ppr[1];
			}
			this.cr = new function () {
				this.fnm = "Отправка/прием файлов через интернет";
				this.pr = ppr[2];
			}
			this.ce = new function () {
				this.nm = "Работа на компе";
				this.fnm = "Работа на компьютере";
				this.me = "мин.";
				this.pr = ppr[3];
			}
			this.cf = new function () {
				this.nm = "Набор текста (1 страница А4)";
				this.fnm = "Набор текста сотрудником компании";
				this.pr = ppr[4];
			}
			this.cg = new function () {
				this.nm = "Доработка файлов клиента";
				this.me = "мин.";
				this.fnm = "Доработка файлов клиента сотрудником компании";
				this.pr = ppr[5];
			}
			this.ch = new function () {
				this.fnm = "Распознавание текста";
				this.me = "стр.";
				this.gr = [0,50,100];
				this.pr = [26.4,19.8,10.56];
				for (k in this.pr) { this.pr[k] = Math.round(this.pr[k]*z)/100; }
			}
			this.ci = new function () {
				this.fnm = "Запись на CD/DVD";
				this.lst = new function () {
					this.cia = new function () {
						this.fnm = "диск клиента";
						this.pr = 200;//ppr[6];
					}
					this.cib = new function () {
						this.fnm = "диск компании";
						this.pr = 200;//ppr[7];
					}
				}
			}
			this.cj = new function () {
				this.fnm = "Сшивание/расшивание";
				this.pr = ppr[8];
			}
			this.ck = new function () {
				this.fnm = "Перфорация листов";
				this.pr = ppr[9];
			}
			this.cn = new function () {
				this.fnm = "Степлер";
				this.pr = ppr[10];
			}
			this.cp = new function () {
				this.fnm = "Биговка";
				this.pr = ppr[11];
			}
			this.cq = new function () {
				this.fnm = "Тиснение";
				this.pr = ppr[12];
			}
			this.cs = new function () {
				this.fnm = "Доставка";
				this.pr = ppr[13];
			}
			this.ct = new function () {
				this.fnm = "Папка скоросшиватель";
				this.pr = ppr[14];
			}
			this.cu = new function () {
				this.fnm = "Файл A4";
				this.pr = ppr[15];
			}
			this.cv = new function () {
				this.fnm = "Файл A3";
				this.pr = ppr[16];
			}
		}
	}

	this.d = new function () {
		this.nm = "Дизайн";
		let pr = [
			[32,550,350,2200,2200,7700], // Услуги, Верстка визитки, Фото на док, Фоторетушь, Верстка макета, Разработка логотипа
			[440,500,550,650], // Печать визиток
			[65,75], // Дизайн бумага
			[770,550,770,1100], // Печати
			[550,110,550,550,825], //Оснастки
			[400,550,300,400,150] //Краски
		]
		this.price = pr;
		this.lst = new function () {
			this.da = new function () {
				this.fnm = "Услуги дизайнера";
				this.me = "мин.";
				this.pr = pr[0][0];
			}
			this.db = new function () {
				this.fnm = "Верстка визитки";
				this.pr = pr[0][1];
			}
			this.dc = new function () {
				this.nm = "Печать визиток";
				this.lst = new function() {
					this.dca = new function() {
						this.nm = "1 сторона ЧБ";
						this.fnm = "Печать односторонней черно белой визитки";
						this.pr = pr[1][0];
					}
					this.dcb = new function() {
						this.nm = "2 стороны ЧБ";
						this.fnm = "Печать двусторонней черно белой визитки";
						this.pr = pr[1][1];
					}
					this.dcc = new function() {
						this.nm = "1 сторона цвет";
						this.fnm = "Печать односторонней цветной визитки";
						this.pr = pr[1][2];
					}
					this.dcd = new function() {
						this.nm = "2 стороны цвет";
						this.fnm = "Печать двусторонней цветной визитки";
						this.pr = pr[1][3];
					}
				}
			}
			this.dd = new function () {
				this.nm = "Дизайн бумага";
				this.lst = new function() {
					this.dda = new function() {
						this.nm = "Диз. бумага";
						this.fnm = "Дизайнерская бумага";
						this.pr = pr[2][0];
					}
					this.ddb = new function() {
						this.nm = "Touche Cover";
						this.fnm = "Touche Cover";
						this.pr = pr[2][1];
					}
				}
			}
			this.de = new function () {
				this.fnm = "Фото на документы";
				this.pr = pr[0][2];
			}
			this.df = new function () {
				this.nm = "Печати";
				this.lst = new function() {
					this.dfa = new function() {
						this.nm = "Круглая печать, штамп или факсимиле";
						this.fnm = "Изготовление круглой печати, штампа или факсимиле";
						this.pr = pr[3][0];
					}
					this.dfb = new function() {
						this.nm = "Маленькие штампы (1-2 слова)";
						this.fnm = "Изготовление маленького штампа";
						this.pr = pr[3][1];
					}
					this.dfc = new function() {
						this.nm = "Печать или штамп по оттиску";
						this.fnm = "Изготовление печати или штампа по оттиску";
						this.pr = pr[3][2];
					}
					this.dfd = new function() {
						this.nm = "Изготовление личной печати, экслибриса";
						this.fnm = "Изготовление личной печати, экслибриса";
						this.pr = pr[3][3];
					}
				}
			}
			this.dg = new function () {
				this.nm = "Оснастки";
				this.lst = new function() {
					this.dga = new function() {
						this.nm = "Авто оснастка GBR";
						this.fnm = "Автоматическая оснастка GBR";
						this.pr = pr[4][0];
					}
					this.dgb = new function() {
						this.nm = "Простая оснастка";
						this.fnm = "Простая оснастка";
						this.pr = pr[4][1];
					}
					this.dgc = new function() {
						this.nm = "Карманная печать";
						this.fnm = "Карманная печать";
						this.pr = pr[4][2];
					}
					this.dgd = new function() {
						this.nm = "Авто для маленьких штампов";
						this.fnm = "Автоматическая оснастка для маленьких штампов";
						this.pr = pr[4][3];
					}
					this.dge = new function() {
						this.nm = "Авто для БОЛЬШИХ штампов";
						this.fnm = "Автоматическая оснастка для больших штампов";
						this.pr = pr[4][4];
					}
				}
			}
			this.dh = new function () {
				this.nm = "Краски";
				this.lst = new function() {
					this.dha = new function() {
						this.fnm = "Подушка 2 pads 50x90";
						this.pr = pr[5][0];
					}
					this.dhb = new function() {
						this.fnm = "Подушка 2 pads 70x110";
						this.pr = pr[5][1];
					}
					this.dhc = new function() {
						this.fnm = "Подушка 50x90";
						this.pr = pr[5][2];
					}
					this.dhd = new function() {
						this.fnm = "Подушка 70x110";
						this.pr = pr[5][3];
					}
					this.dhe = new function() {
						this.fnm = "Краска";
						this.pr = pr[5][4];
					}
				}
			}
			this.di = new function () {
				this.fnm = "Фоторетушь";
				this.me = "час";
				this.pr = pr[0][3];
			}
			this.dj = new function () {
				this.fnm = "Верстка макета";
				this.me = "час";
				this.pr = pr[0][4];
			}
			this.dk = new function () {
				this.fnm = "Разработка логотипа";
				this.pr = pr[0][5];
			}
		}
	}

	this.e = new function () {
		this.nm = "Багетка";
		this.lst = new function () {
			this.ea = new function () {
				this.fnm = "Накатка на пенокартон";
				let pr = [
					[85,170,340,680,1360,1360], //5 мм
					[110,220,440,880,1760,1760] //10 мм
				]
				this.price = pr;
				this.lst = new function () {
					this.eaa = new function () {
						this.fnm = "5 мм";
						this.lst = new function () {
							this.eaaa = new function () {
								this.nm = "А4";
								this.fnm = "формат А4";
								this.pr = pr[0][0];
							}
							this.eaab = new function () {
								this.nm = "А3";
								this.fnm = "формат А3";
								this.pr = pr[0][1];
							}
							this.eaac = new function () {
								this.nm = "А2";
								this.fnm = "формат А2";
								this.pr = pr[0][2];
							}
							this.eaad = new function () {
								this.nm = "А1";
								this.fnm = "формат А1";
								this.pr = pr[0][3];
							}
							this.eaae = new function () {
								this.nm = "А0";
								this.fnm = "формат А1";
								this.pr = pr[0][4];
							}
							this.eaaf = new function () {
								this.nm = "1 кв.м";
								this.fnm = "1 кв.м";
								this.me = "кв.м.";
								this.pr = pr[0][5];
							}
						}
					}
					this.eab = new function () {
						this.fnm = "10 мм";
						this.lst = new function () {
							this.eaba = new function () {
								this.nm = "А4";
								this.fnm = "формат А4";
								this.pr = pr[1][0];
							}
							this.eabb = new function () {
								this.nm = "А3";
								this.fnm = "формат А3";
								this.pr = pr[1][1];
							}
							this.eabc = new function () {
								this.nm = "А2";
								this.fnm = "формат А2";
								this.pr = pr[1][2];
							}
							this.eabd = new function () {
								this.nm = "А1";
								this.fnm = "формат А1";
								this.pr = pr[1][3];
							}
							this.eabe = new function () {
								this.nm = "А0";
								this.fnm = "формат А0";
								this.pr = pr[1][4];
							}
							this.eabf = new function () {
								this.nm = "1 кв.м";
								this.fnm = "1 кв.м";
								this.me = "кв.м.";
								this.pr = pr[1][5];
							}
						}
					}
				}
			}
			this.eb = new function () {
			  this.fnm = "Накатка на п/к для студентов";
			  let pr = [
			    [75, 150, 300, 600, 1200, 1200], //5 мм
			    [100, 200, 400, 800, 1600, 1600] //10 мм
			  ]
			  this.price = pr;
			  this.lst = new function () {
			    this.eba = new function () {
			      this.fnm = "5 мм";
			      this.lst = new function () {
			        this.ebaa = new function () {
			          this.nm = "А4";
			          this.fnm = "формат А4";
			          this.pr = pr[0][0];
			        }
			        this.ebab = new function () {
			          this.nm = "А3";
			          this.fnm = "формат А3";
			          this.pr = pr[0][1];
			        }
			        this.ebac = new function () {
			          this.nm = "А2";
			          this.fnm = "формат А2";
			          this.pr = pr[0][2];
			        }
			        this.ebad = new function () {
			          this.nm = "А1";
			          this.fnm = "формат А1";
			          this.pr = pr[0][3];
			        }
			        this.ebae = new function () {
			          this.nm = "А0";
			          this.fnm = "формат А1";
			          this.pr = pr[0][4];
			        }
			        this.ebaf = new function () {
			          this.nm = "1 кв.м";
			          this.fnm = "1 кв.м";
			          this.me = "кв.м.";
			          this.pr = pr[0][5];
			        }
			      }
			    }
			    this.ebb = new function () {
			      this.fnm = "10 мм";
			      this.lst = new function () {
			        this.ebba = new function () {
			          this.nm = "А4";
			          this.fnm = "формат А4";
			          this.pr = pr[1][0];
			        }
			        this.ebbb = new function () {
			          this.nm = "А3";
			          this.fnm = "формат А3";
			          this.pr = pr[1][1];
			        }
			        this.ebbc = new function () {
			          this.nm = "А2";
			          this.fnm = "формат А2";
			          this.pr = pr[1][2];
			        }
			        this.ebbd = new function () {
			          this.nm = "А1";
			          this.fnm = "формат А1";
			          this.pr = pr[1][3];
			        }
			        this.ebbe = new function () {
			          this.nm = "А0";
			          this.fnm = "формат А0";
			          this.pr = pr[1][4];
			        }
			        this.ebbf = new function () {
			          this.nm = "1 кв.м";
			          this.fnm = "1 кв.м";
			          this.me = "кв.м.";
			          this.pr = pr[1][5];
			        }
			      }
			    }
			  }
			}
		}
	}

    this.g = new function () {
                this.nm = "Прочее";
                let gr = [0]; //градиент цен
                
                let pr = [
                    [8,15]

                ];
                console.log(pr[0][1]);
                this.grad = gr;
                this.price = pr;
                this.lst = new function() {

                    this.ga = new function() {
                        this.nm = "Фальцовка";//футболки
                        this.fnm = "Фальцовка";
                        this.lst = new function() {
                            this.gaa = new function() {
                                this.nm = "А4";//футболки
                                this.fnm = "А4";
                                    // this.gr = gr;
                                    this.pr = pr[0][0];
                            }
                            this.gab = new function() {
                                this.nm = "А3";//футболки
                                this.fnm = "А3";
                                    // this.gr = gr;
                                    this.pr = 4.76;
                            }
							this.gac = new function() {
                                this.nm = "А2";//футболки
                                this.fnm = "А2";
                                    // this.gr = gr;
                                    this.pr = 9.51;
                            }
							this.gad = new function() {
                                this.nm = "А1";//футболки
                                this.fnm = "А1";
                                    // this.gr = gr;
                                    this.pr = 15.86;
                            }
							this.gae = new function() {
                                this.nm = "А0";//футболки
                                this.fnm = "А0";
                                    // this.gr = gr;
                                    this.pr = 17.44;
                            }
                        }	
                    }
                    this.gb = new function() {
                        this.nm = "Сканирование (цветное)";//футболки
                        this.fnm = "Сканирование (цветное)";
                        this.lst = new function() {
							this.gba = new function() {
                                this.nm = "А2";//футболки
                                this.fnm = "А2";
                                    // this.gr = gr;
                                    this.pr = 38.05;
                            }
							this.gbb = new function() {
                                this.nm = "А1";//футболки
                                this.fnm = "А1";
                                    // this.gr = gr;
                                    this.pr = 57.08;
                            }
							this.gbc = new function() {
                                this.nm = "А0";//футболки
                                this.fnm = "А0";
                                    // this.gr = gr;
                                    this.pr = 114.16;
                            }
                        }	
                    }
                }
    }
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
  // console.log(obj);
  req.send('post=' + encodeURIComponent(JSON.stringify(mainoffers)));
// console.log(req.statusText);
}
const POSTLOAD = (idloadcheck,funcload) => {
  let req = new XMLHttpRequest();
  req.onreadystatechange = function () {
    if (req.readyState == 4) {
      let resp = req.responseText;
      // console.log(resp);
      funcload(resp);
    }
  }
  // console.log(chek.dataoffers);

  req.open('POST', 'loadcheck.php', true);
  req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  // console.log(obj);
  req.send('idloadcheck=' + encodeURIComponent(JSON.stringify(idloadcheck)));
// console.log(req.statusText);
}

let chek = new function () {
  this.const = function () {
    this.id = 0; //Номер чека
    this.cn = inpName.value; //Название компании если это безнал
    this.dir = 0; //Скидка в рублях
    this.dip = 0; //Скидка в процентах
    this.fx = 0; //Проведён ли чек 0 - непроведен, 1 - оплата налом, 2 - оплата картой, 3 - юр лица
    this.sum = 0 //Сумма чека
    this.telc = tel.value; //Название компании если это безнал
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
      inpDiscProc.value = this.data.dip =(Math.round(n * 100) / 100);
      inpDiscRub.value = this.data.dir =(Math.round(sum * this.data.dip) / 100);
    } else {
      inpDiscRub.value = this.data.dir =(Math.round(n * 100) / 100);
      inpDiscProc.value = this.data.dip =(Math.round(10000 * this.data.dir / sum) / 100);
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


    if (($("#qazwsx").length > 0 && document.getElementById( "qazwsx" ).innerText == "Способ оплаты: на р/с") || $("#butUrl").hasClass("sel") ) {
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
          <td>Услуга</td>
          <td>Кол-во</td>
          <td>Ед.</td>
          <td>Цена</td>
          <td>Стоимость</td>
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
          <td colspan="5">Скидка ${dip}%</td>
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
    let nds =(Math.round(16.66 * sum) / 100);
    for (k in itogosnds) {
      if (!(nds - Math.floor(nds))) {
        itog = nds + ".00";
      } else {
        itog = nds;
      }
      itogosnds[k].innerHTML = "В том числе НДС: <b>" + itog + "</b> ( " + main.numToStr(nds) + " )";
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
      document.getElementById('infoCheckSave').innerHTML = "✓ Чек сохренен";

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
        document.getElementById('infoCheckSave').innerHTML = "✓ Чек сохренен";

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
        xmlhttp.open('POST', 'loadcheck.php', true); // Открываем асинхронное соединение
        xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); // Отправляем кодировку
        xmlhttp.send("idloadcheck=" + encodeURIComponent(idloadcheck)); // Отправляем POST-запрос
        xmlhttp.onreadystatechange = function() { // Ждём ответа от сервера
          if (xmlhttp.readyState == 4) { // Ответ пришёл
            if(xmlhttp.status == 200) { // Сервер вернул код 200 (что хорошо)
               document.getElementById("wrapChek").innerHTML = xmlhttp.responseText; // Выводим ответ сервера
              let priceContent = document.getElementById('priceConteiner').textContent;
              document.getElementById('wrapTovarchekNalFoot').innerHTML = "Итого "+priceContent+" ("+main.numToStr(priceContent)+").<br><br><br><br>___________________ ИП Васюков";
              new TableExport(document.getElementById("tablecheck"),{
                headers: true,                      // (Boolean), display table headers (th or td elements) in the <thead>, (default: true)
                footers: true,                      // (Boolean), display table footers (th or td elements) in the <tfoot>, (default: false)
                formats: ["xlsx",  "txt"],    // (String[]), filetype(s) for the export, (default: ['xlsx', 'csv', 'txt'])
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
              // Определите таблицу, которую вы хотите экспортировать
             var  $myTable  = $('#tablecheck');
            // Отсоедините html-кнопки
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


  /*  let xmlhttp = new XMLHttpRequest();
        xmlhttp.open('POST', 'loadcheckCher.php', true); // Открываем асинхронное соединение
        xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); // Отправляем кодировку
        xmlhttp.send("idloadcheck=" + encodeURIComponent(idloadcheck)); // Отправляем POST-запрос
        xmlhttp.onreadystatechange = function() { // Ждём ответа от сервера
          if (xmlhttp.readyState == 4) { // Ответ пришёл
            if(xmlhttp.status == 200) { // Сервер вернул код 200 (что хорошо)
              console.log(xmlhttp.responseText)
              // document.getElementById("wrapChek").innerHTML = xmlhttp.responseText; // Выводим ответ сервера
            //  let priceContent = document.getElementById('priceConteiner').textContent;
              //document.getElementById('wrapTovarchekNalFoot').innerHTML = "Итого "+priceContent+" ("+main.numToStr(priceContent)+").<br><br><br><br>___________________ ИП Васюков";
            }
          }
        };
        let innerCheckId = document.getElementsByClassName('chekId');
            for (k in innerCheckId) {
               innerCheckId[k].innerHTML = "№ " + idloadcheck;
            }*/
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
    this.price = inpPrice.value =(Math.round(n * 100) / 100);
    metricSpan.innerHTML = this.getMetric(this.id);
    this.countSum();
  }

  this.countSum = function () {
    this.sum = inpSum.value =(Math.round(this.price * this.num * 100) / 100);
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
    // console.log(id);
    let obj = base[id[0]];
    // console.log(obj);
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
      ['', 'один ', 'два ', 'три ', 'четыре ', 'пять ', 'шесть ', 'семь ', 'восемь ', 'девять '],
      ['', 'одна ', 'две ', 'три ', 'четыре ', 'пять ', 'шесть ', 'семь ', 'восемь ', 'девять '],
    ];
    let twen = ['десять ', 'одиннадцать ', 'двенадцать ', 'тринадцать ', 'четырнадцать ', 'пятнадцать ', 'шестнадцать ', 'семнадцать ', 'восемнадцать ', 'девятнадцать '];
    let tens = ['', '', 'двадцать ', 'тридцать ', 'сорок ', 'пятьдесят ', 'шестьдесят ', 'семьдесят ', 'восемьдесят ', 'девяносто '];
    let hundr = ['', 'сто ', 'двести ', 'триста ', 'четыреста ', 'пятьсот ', 'шестьсот ', 'семьсот ', 'восемьсот ', 'девятьсот '];
    let unit = [
      [1, 'копеек', 'копейка', 'копейки'],
      [0, 'рублей ', 'рубль ', 'рубля '],
      [1, 'тысяч ', 'тысяча ', 'тысячи '],
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
      for (var i = id.length; i < 7; i++) {
        document.getElementById('m' + i).className = 'menu ' + tid;
        tid += 'a';
      }
      if (obj.pr) {
        serv.id = id;
        serv.setNum(1);
      } else {
        tid = id;
        for (var i = id.length + 1; i < 7; i++) {
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
