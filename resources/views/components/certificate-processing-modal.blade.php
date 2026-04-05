<div
    id="certificateProcessingModal"
    class="fixed inset-0 z-[999] hidden items-center justify-center bg-black/30 px-4"
    onclick="closeCertificateModal()"
>
    <div
        class="relative w-full max-w-[416px] rounded-[24px] bg-[#14B3D8] px-8 py-8 shadow-[0_24px_60px_rgba(0,0,0,0.35)]"
        onclick="event.stopPropagation()"
    >
        <div class="mb-8 flex justify-center">
            <div class="flex h-[124px] w-[124px] items-center justify-center rounded-full bg-gradient-to-b from-[#6DBBFF] to-[#3D79F3] shadow-[inset_0_3px_10px_rgba(255,255,255,0.35),0_4px_12px_rgba(0,0,0,0.2)]">
                <div
                    class="h-[74px] w-[52px] bg-[#EDEDED] shadow-[inset_0_2px_4px_rgba(255,255,255,0.8),0_4px_10px_rgba(0,0,0,0.18)]"
                    style="clip-path: polygon(0 0, 100% 0, 100% 100%, 50% 78%, 0 100%); border-radius: 8px 8px 6px 6px;"
                ></div>
            </div>
        </div>

        <h2 class="mx-auto mb-6 max-w-[280px] text-center text-[24px] font-extrabold leading-[1.05] text-white">
            Certificates are still being processed
        </h2>

        <div class="mx-auto mb-14 w-full max-w-[288px] rounded-[8px] border-2 border-[#356CF3] bg-[#F2F2F2] p-[3px]">
            <div
                class="h-[20px] w-[58%] rounded-[4px] border border-[#356CF3]"
                style="background: repeating-linear-gradient( -45deg, #D8E7FF 0px, #D8E7FF 8px, #7EA8FF 8px, #7EA8FF 11px );"
            ></div>
        </div>

        <a
            href="/dashboard-design"
            class="flex h-[48px] w-full items-center justify-center rounded-[12px] bg-[#FF6A27] text-[16px] font-bold text-white"
        >
            Enter Dashboard
        </a>
    </div>
</div>
