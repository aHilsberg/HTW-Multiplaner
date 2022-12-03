import { Dataset, createPlaywrightRouter } from "crawlee";

// var testMaxLimit = 5;

export const router = createPlaywrightRouter();
router.addDefaultHandler(async ({ enqueueLinks, page, log }) => {
  log.info(`enqueueing new URLs`);

  // if (testMaxLimit == 0) return;

  await page.waitForSelector("#tx-ezqueries-content");

  await enqueueLinks({
    selector: "a.page-link",
    label: "list",
    // limit: testMaxLimit,
  });

  await enqueueLinks({
    selector: "a.tx-ezqueries-list-link-detail",
    regexps: [
      /https:\/\/apps\.htw-dresden\.de\/app-modulux\/frontend\/ausgabe\/module\/.*/g,
    ],
    label: "module",
    // limit: testMaxLimit,
  });

  // testMaxLimit = Math.max(0, testMaxLimit - 1);
});

router.addHandler("module", async ({ request, page, log }) => {
  const textOf = async (identifierClass: string) => {
    var text = await page.locator("div." + identifierClass).innerText();

    text = text.trim();

    const textContent = (text: string) => {
      const content = text.split("\n");
      return {
        label: content[0],
        details: content.slice(1),
      };
    };

    // reduce level
    if (text.includes("\n\n\n")) {
      text = text.replace(/\n\n\n/g, "\n");
    }

    return text.includes("\n")
      ? text.includes("\n\n")
        ? text.split("\n\n").map(textContent)
        : textContent(text)
      : text;
  };

  const name = await textOf("tx-ezqueries-detail-data-m_mod-bez");
  const id = (
    (await textOf("tx-ezqueries-detail-data-m_mod-nr_standard")) as {
      label: string;
      details: string[];
    }
  ).label.split(" ")[0];

  log.info("module", { id });

  const faculty = await textOf("tx-ezqueries-detail-data-m_orgeinheit-bez");
  const level = await textOf("tx-ezqueries-detail-data-k_niveau-bez");
  const semesterCount = await textOf(
    "tx-ezqueries-detail-data-k_mod_semzahl-semzahl"
  );
  const events = await textOf("tx-ezqueries-detail-data-modul_sws_value");
  const superviser = await textOf(
    "tx-ezqueries-detail-data-modul_verantwortlicher_value"
  );
  const lecturer = await textOf(
    "tx-ezqueries-detail-data-modul_dozenten_value"
  );
  const languages = await textOf(
    "tx-ezqueries-detail-data-modul_lehrsprachen_value"
  );
  const credits = await textOf("tx-ezqueries-detail-data-modul_credits_value");
  const workload = await textOf(
    "tx-ezqueries-detail-data-modul_workload_value"
  );
  const preExaminationWork = await textOf(
    "tx-ezqueries-detail-data-modul_pruefungsvorleistungen_value"
  );
  const examinationWork = await textOf(
    "tx-ezqueries-detail-data-modul_pruefungsleistungen_value"
  );
  const content = await textOf("tx-ezqueries-detail-data-m_mod-lehrinhalt");
  const skills = await textOf("tx-ezqueries-detail-data-m_mod-fachl_kompetenz");
  const requirementsNeeded = await textOf(
    "tx-ezqueries-detail-data-m_mod-notw_vorauss"
  );
  const requirementsOptional = await textOf(
    "tx-ezqueries-detail-data-m_mod-empf_vorauss"
  );
  const opalUrl = await textOf("tx-ezqueries-detail-data-m_mod-opal_link");

  await Dataset.pushData({
    id,
    name,
    faculty,
    level,
    languages,
    superviser,
    lecturer,
    semesterCount,
    events,
    workload,
    credits,
    preExaminationWork,
    examinationWork,
    content,
    skills,
    requirementsNeeded,
    requirementsOptional,
    modulux: request.url,
    opal: opalUrl,
  });
});
