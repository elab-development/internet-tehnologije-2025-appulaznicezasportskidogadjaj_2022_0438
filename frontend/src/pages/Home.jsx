import { Link } from "react-router-dom"
import Karte from "./Karte";
import Kartice from "../components/Kartice";
import { IoTicketSharp, IoNotifications } from 'react-icons/io5'
import { MdOutlineSportsSoccer } from 'react-icons/md'

export default function Home() {

  const features = [
    {
      id: 'karte',
      title: "Rezervacija karata",
      Icon: <IoTicketSharp />,
      items: [
        "Brza rezervacija karata za sportske događaje",
        "Pregled slobodnih mesta i cena",
        "Digitalne karte dostupne online",
        "Pregled svih kupljenih karata na jednom mestu"
      ]
    },
    {
      id: 'dogadjaji',
      title: "Sportski događaji",
      Icon: <MdOutlineSportsSoccer />,
      items: [
        "Pregled lokalnih i regionalnih događaja",
        "Filtriranje po sportu, datumu i lokaciji",
        "Detaljne informacije o utakmicama",
        "Najave predstojećih događaja"
      ]
    },
    {
      id: 'pracenje',
      title: "Praćenje i obaveštenja",
      Icon: <IoNotifications />,
      items: [
        "Podsetnici za kupljene događaje",
        "Istorija posećenih utakmica",
        "Obaveštenja o promenama termina",
        "Personalizovane preporuke"
      ]
    }
  ];

  return (
    <div className="pocetna">
      <header className="pocetna-hero">
        <div className="pocetna-hero-content">

          <h1 className="pocetna-title">
            Sportski Događaji <br />
            Sve utakmice na jednom mestu
          </h1>

          <p className="pocetna-subtitle">
            Prati aktuelne sportske događaje u tvom gradu i rezerviši karte
            brzo, lako i bez čekanja. Budi deo atmosfere – uživo.
          </p>

          <div className="pocetna-hero-actions">
            <Link to="/dogadjaji" className="btn-primary">
              Pregledaj događaje
            </Link>
            <Link to="/karte" className="btn-secondary">
              Moje karte
            </Link>
          </div>

          <div className="pocetna-hero-meta">
            <span><MdOutlineSportsSoccer /> Lokalni sportski događaji</span>
            <span><IoTicketSharp /> Brza i sigurna rezervacija</span>
          </div>
        </div>

        {/* DESNA KARTICA */}
        <div className="pocetna-hero-card">
          <div className="pocetna-balance-label">Događaji ove nedelje</div>
          <div className="pocetna-balance-value">12</div>

          <div className="pocetna-balance-pillovi">
            <div className="pill pill-priliv">
              + 5
              <span>Fudbal</span>
            </div>

            <div className="pill pill-odliv">
              + 4
              <span>Košarka</span>
            </div>

            <div className="pill pill-neutral">
              + 3
              <span>Ostali sportovi</span>
            </div>
          </div>
        </div>
      </header>

      <section className="pocetna-section">
        <h2>Čemu naša apliakcija služi?</h2>

        <p className="pocetna-section-subtitle">
          Aplikacija ti omogućava da brzo pronađeš sportske događaje,
          rezervišeš karte i uvek budeš u toku sa aktuelnim utakmicama.
        </p>

        <div className="pocetna-grid">
          {features.map(features => (
            <Kartice
              key={features.id}
              title={features.title}
              Icon={features.Icon}
              items={features.items}
            />
          ))}

        </div>
      </section>

      <section className="pocetna-section pocetna-cta">
        <div className="pocetna-cta-box">
          <h2>Prati svoje omiljene sportske događaje već danas</h2>
          <p>
            Registruj se besplatno i budi u toku sa svim utakmicama, rezultatima i promocijama.
            Brzo rezerviši karte i uživaj u sportskim spektaklima uživo!
          </p>
          <div className="pocetna-hero-actions">
            <Link to="/register" className="btn-primary">Kreiraj nalog</Link>
            <Link to="/login" className="btn-secondary">Već imam nalog</Link>
          </div>
        </div>
      </section>




    </div>
  )
}
